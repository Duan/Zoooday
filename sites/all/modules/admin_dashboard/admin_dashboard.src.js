$(function() {
  // Avoid dashboard form being opened in popup windows.
  if (!window.opener && !window.parent.Drupal.admin_dashboard) {
    Drupal.admin_dashboard = new admin_dashboard();
  };
});

function admin_dashboard() {
  var dash             = this;
  dash.menu_obj        = $("#temp_admin_dashboard_menu");
  dash.blocks_obj      = $("#temp_admin_dashboard_blocks");
  dash.atstart         = false;
  dash.has_blocks      = false;
	dash.position        = Drupal.settings.admin_dashboard_position;
	dash.top 						 = Drupal.settings.admin_dashboard_top
	dash.menuItems 			 = $('.admin_dashboard_menuitem');
  dash.is_large        = ($('#region_admin_dashboard div').size() > 0);
  dash.block_content   = $('#region_admin_dashboard').children();
  dash.togglebar_width = 26;
  dash.settings_width  = 24;
	dash.icon_width  		 = 44;
  dash.menu_height     = 79;
  dash.blocks_width    = 0;
  dash.hide_on_init    = Drupal.settings.admin_dashboard_hide_on_init;
  dash.at_start        = Drupal.settings.admin_dashboard_at_start;
  dash.submenu_highest = 0;
  dash.setting_buttons = Drupal.settings.setting_buttons;
	dash.position_flip   = (dash.position == 'right') ? 'left' : 'right';
  
  dash.container_width;
  dash.menu_width;
  dash.container_obj;
  dash.wrapper_obj;
  dash.togglebar_obj;
  dash.content_obj;
  dash.block_content_obj;
  dash.settings_obj;
  
  dash.init = function() {
    dash.placeDashboard();
		dash.placeDashboardMask();
    dash.placeBlockContent();
    dash.placeSettingsButtons();
    dash.setWidth();
    dash.addEventListeners();
    dash.submenuDimensions();
		dash.titleWidthULPosition();
    dash.fixIconTitle();
    dash.animate(true);
		dash.firstrun = 1;
  };
	
	/**
   * Set the width of the title div and set the postion of the ul submenu
   */
	dash.titleWidthULPosition = function() {
		dash.menuItems.each(function() {
			
			// Width of the title
			var width = $(this).find('span').width();
			$(this).find('.admin_dashboard_menuitem_icontekst').css({'width': width + 'px', 'left': ((width / 2) - width) + 'px'});
			
			// Postion of submenu ul
			$(this).find('li ul').each(function() {
				ul_style = {};
				ul_style[dash.position_flip] = '-' + ($(this).width() + 20) + 'px';
				$(this).css({'left':'auto', 'right':'auto'});
				$(this).css(ul_style);
      });
			
		});		
	};
  
  /**
   * Fix postion of the icon text
   */
  dash.fixIconTitle = function() {
		// This is the Icon
    var iconWidth = $('.admin_dashboard_menuitem:first').width();
    // Icon with with the margin left and right side
    var fullIconWidth = iconWidth + parseInt($('.admin_dashboard_menuitem:first').css('margin-left')) + parseInt($('.admin_dashboard_menuitem:first').css('margin-right'));
    // How many icons do we have
    var iconCount = $('.admin_dashboard_menuitem').children('.admin_dashboard_menuitem_text_position').size();
    var counter = 0;
    
		$('.admin_dashboard_menuitem').each(function() {
      // Calculate if the text overlays left side
      if(dash.position == 'right') {
				// calculate how long the text can maximal be on the left side
				var max_pix_allowed = Math.floor((fullIconWidth * counter) + (fullIconWidth / 2) - 5);
			} else {
				var max_pix_allowed = Math.floor((fullIconWidth * (iconCount - (counter + 1))) + (fullIconWidth / 2) - 5);
				// Add the difference of the blockwith and menuwith if blockwith if bigger than menuwith
				if((dash.blocks_width - 24) > dash.menu_width) {
					max_pix_allowed += (dash.blocks_width - 24) - dash.menu_width;
				};
			};
      var text_half = Math.ceil($(this).find('.admin_dashboard_menuitem_icontekst span').width() / 2);
      if(text_half > max_pix_allowed) {
        var difference = Math.ceil(iconWidth / 2) + (text_half - max_pix_allowed);
				$(this).find('.admin_dashboard_menuitem_text_position').css('left', difference + 'px');
      };
      
      // Calculate if the text overlays the right side
      if(dash.position == 'right') {
				var max_pix_allowed = Math.floor((fullIconWidth * ((iconCount - 1) - counter)) + (iconWidth / 2));
				if((dash.blocks_width - 24) > dash.menu_width) {
					max_pix_allowed += (dash.blocks_width - 24) - dash.menu_width;
				};
			} else {
				var max_pix_allowed = Math.floor((fullIconWidth * counter) + (fullIconWidth / 2));
			};
			if(text_half > max_pix_allowed) {
        var difference = Math.ceil(iconWidth / 2) - (text_half - max_pix_allowed);
				$(this).find('.admin_dashboard_menuitem_text_position').css('left', difference - 3 + 'px');      
      };
      
      counter = counter + 1;
    });
  };
  
  /**
   * 
   */
  dash.placeDashboard = function() {
		var container_style = {'top': dash.top + 'px', 'display': 'block', 'visibility': 'hidden'};
		container_style[dash.position] = '0px';
		// Place the elements which needs to be globally accesible to the body first
		
		dash.container_obj = $("<div />").attr('id', 'admin_dashboard_container').css(container_style).appendTo('body');
//		dash.wrapper_obj = $("<div />").attr('id', 'admin_dashboard_content_wrapper').appendTo(dash.container_obj);
		dash.content_obj = $('<div id="admin_dashboard_content" />').appendTo(dash.container_obj).append(dash.menu_obj);

		var props = {
		  'width':'0px', 'height':'0px', 'background':'red', 'position':'absolute', 'top':'0px'
		};
		props[(dash.position == 'right' ? 'left' : 'right')] = '26px';
		dash.togglebar_pos_obj = $('<div />').attr({'id':'togglebar_pos'}).css(props);
		if (dash.position == 'left') {
      dash.togglebar_pos_obj.appendTo(dash.container_obj);
		} else {
      dash.togglebar_pos_obj.prependTo(dash.container_obj);
		};
		dash.settings_obj = $('<div />').attr('id', 'admin_dashboard_settings').appendTo(dash.togglebar_pos_obj);
		dash.togglebar_bar_obj = $('<div />').attr({'id':'admin_dashboard_togglebar_bar'});
		dash.togglebar_obj = $('<div />').attr({'id':'admin_dashboard_togglebar'}).appendTo(dash.togglebar_pos_obj).append(
      $('<div />').attr({'id':'admin_dashboard_togglebar_shadowtop'})
    ).append(
      $('<div />').attr({'id':'admin_dashboard_togglebar_shadowleft'})
    ).append(
      dash.togglebar_bar_obj
    ).append(
      $('<div />').attr({'id':'admin_dashboard_togglebar_bottom'})
    );

		if (dash.position == 'left') {
			dash.container_obj.addClass('pos_left');
		}
    
    if (dash.is_large) {
      dash.container_obj.addClass('large');
    };
  };
	
	dash.placeDashboardMask = function() {
		if(dash.firstrun == null) {
			// Display is hidden exept when moving admin_dashboard
			$("<div />").attr('id', 'admin_dashboard_mask').appendTo('body');
		};
	};
  
  /**
   * 
   */
  dash.placeSettingsButtons = function() {
		var icon = dash.setting_buttons['auto_hide']['icon'];
		if(dash.hide_on_init == true && dash.firstrun == null) {
			icon = icon.replace(/.png/, '_enabled.png');
		};
		if(dash.position == 'left') {
			icon = icon.replace(/_icon/, '_icon_left');
		} else {
			icon = icon.replace(/_icon_left/, '_icon');
		};
		dash.setting_buttons['auto_hide']['icon'] = icon;
    $.each(dash.setting_buttons, function(name, data) {																					
    dash.settings_obj.append('<a id="admin_dashboard_' + name + '_icon" href="' + ((data.href) || '#') + '" alt="' + data.alt + '" title="' + data.alt + '" style="background-image:url(\'' + data.icon + '\');" class="settings_button"></a>');
    });
  };
  
  /**
   * 
   */
  dash.placeBlockContent = function() {
    if(dash.block_content.size() > 0) {
      dash.has_blocks = true;
      dash.container_obj.addClass('large');
      dash.block_content_obj = $('<div id="admin_dashboard_block_container" />').prependTo(dash.content_obj);
      
     dash.blocks_width    = 30; // The padding of the container div
     dash.block_content_obj.append(dash.block_content);

			dash.block_content_obj.find('.block, .block-region').each(function() {
        var block = $(this);
        var wrapper = $('<div class="block_wrapper" />').appendTo(block.parent());

        if (block.hasClass('block-region')) {
          wrapper.append(block);
				} else {
          wrapper.append('<div class="left" />').append(block).append('<div class="right" />');
        };

				dash.blocks_width += wrapper.width() + 5; // The margin of this block
      });
    };
  };
  
  dash.submenuDimensions = function() {
    $('.admin_dashboard_menuitem ul').each(function() {
      dash.submenu_highest = ($(this).height() > dash.submenu_highest) ? $(this).height() : dash.submenu_highest;
    });
  };
	
	/**
   * Rebuild dashboard 
   */
	dash.switchSide = function() {
		dash.position   = (dash.position == 'right') ? 'left' : 'right';
		dash.position_flip   = (dash.position == 'right') ? 'left' : 'right';
		dash.container_obj.remove();
		dash.init();
		if(dash.position == 'right') {
			dash.container_obj.removeClass('pos_left');
			dash.container_obj.css({'left':'auto', 'right':'0px'});
		} else {
			dash.container_obj.addClass('pos_left');
			dash.container_obj.css({'left':'0px', 'right':'auto'});
		}
	}
	  
  /**
   * Event and handlers
   */
  dash.addEventListeners = function() {
    
		// move in and out 
		dash.togglebar_bar_obj.click( function() {
      dash.animate();
      return false;
    });
		
		dash.handler_dragging();
		dash.handler_settings();
		dash.handler_menu();

  };
	
	dash.handler_menu = function() {
		
		dash.menuItems.each(function() {
      
			$(this).hover(function() {														 
				// prevent this code getting activated when dashboard moves in
				if(!dash.at_start) {
					
					// Remove overflow hidden when postion is right
					if(dash.position == 'right') {
						//dash.container_obj.css('overflow', 'visible');
						dash.container_obj.css('overflow-x', 'hidden');
					}
					
         	// Show icon tekst
					$(this).find('.admin_dashboard_menuitem_icontekst').css('visibility', 'visible');
					
					dash.first_ul = $(this).find('ul:first');
					if(dash.first_ul.width() != null) {
						
						// ul align right
						var ul = $(this).find('ul:first'); 
						if(ul.width() > dash.icon_width) {
							var next_id = parseInt($(this).attr('id').replace('admin_dashboard_menuitem_', '')) + 1;
							if($('#admin_dashboard_menuitem_' + next_id).size() < 1) {								
								// Let last ul not touch the right side bar
								if(dash.position == 'right') {
									ul.css('margin', '0px 0px 0px -' + (ul.width() - dash.icon_width + 10) + 'px');
								} else {
									ul.css('margin', '0px ' + (ul.width() - dash.icon_width + 10) + 'px 0px 0px');
								}
							} else {
								if(dash.position == 'right') {
									ul.css('margin', '0px 0px 0px -' + (ul.width() - dash.icon_width) + 'px');
								} else {
									ul.css('margin', '0px ' + (ul.width() - dash.icon_width) + 'px 0px 0px');
								}
							}
						}
						
						// Show the submenu
						$(this).children('ul:first').css({'visibility':'visible'});
						// Adjust the parent containers height, otherwise it's overflow will hide the submenu
						dash.menu_obj.height(dash.submenu_highest + dash.menu_height);
					}
					
        };
      }, function() {
				if(dash.position == 'right') {
					dash.container_obj.css('overflow', 'hidden');
				};
        if(!dash.at_start) {
					dash.container_obj.css({'padding': (dash.position == 'left' ? '0px 50px 0px 0px' : '0px 0px 0px 26px')});
					$(this).find('.admin_dashboard_menuitem_icontekst').css('visibility', 'hidden');
          $(this).find('ul:first').css({'visibility':'hidden', 'margin':'0px'});
          dash.menu_obj.height(dash.menu_height);
        };
      });
      
			// make submenu's visible
      $(this).find('li ul').each(function() {
        $(this).parent().hover(function() {
					$(this).children('ul').css('visibility', 'visible');
        }, function() {
          $(this).children('ul').css('visibility', 'hidden');
        });
      });
			
    });
	};
	
	dash.handler_settings = function() {
		// Click this icon for auto hide the dashboard
    $('#admin_dashboard_auto_hide_icon').click(function() {
      dash.toggleStartPositionIcon();
      dash.saveData();
      return false;
    });
	};
	
	dash.toggleStartPositionIcon = function() {
    var bg_img = $('#admin_dashboard_auto_hide_icon').css('background-image');
    if(bg_img.search(/enabled/) != -1) {
      dash.hide_on_init = false;
      $('#admin_dashboard_auto_hide_icon').css({'background-image': bg_img.replace(/_enabled.png/, '.png')});
			dash.setting_buttons['auto_hide']['icon'] = dash.setting_buttons['auto_hide']['icon'].replace(/_enabled.png/, '.png');
    } else {
      dash.hide_on_init = true;
      dash.at_start = false;
      $('#admin_dashboard_auto_hide_icon').css({'background-image': bg_img.replace(/.png/, '_enabled.png')});
			dash.setting_buttons['auto_hide']['icon'] = dash.setting_buttons['auto_hide']['icon'].replace(/.png/, '_enabled.png');
    };
  };
	
	dash.handler_dragging = function () {
		// Move vertical
		$('#admin_dashboard_togglebar_bar').mousedown(function(event) {																					 
			// Firefox fix, prevent dragging images
			if(event.preventDefault) {
  			event.preventDefault();
 			}
			// Disable text
			if ($.fn.disableTextSelect) {
			 $('body').disableTextSelect();
		  };
			// We will check if this class is still set over 0,5 second
			$(this).addClass('mousedown');
			$(document).unbind('mouseup').mouseup(function() {
  			// Enable text
  			if ($.fn.enableTextSelect) {
  			 $('body').enableTextSelect();
  		  };
				$('#admin_dashboard_togglebar_bar').removeClass('mousedown');
			});
			setTimeout(function() {
				// Check if class is still mousedown
				if($('#admin_dashboard_togglebar_bar').attr('class') == 'mousedown') {
					// The dashboard mask has cursor move property
					$('#admin_dashboard_mask').show();
					
					// Vertical
					$(document).unbind('mousemove').mousemove(function(e) {
						// fixed mouseposition
						if(dash.bar_y == null) {
							dash.bar_y = parseInt(e.pageY) - dash.top;
						}																						 
						// this variable also used in the ajax function for saving position
						dash.top = parseInt(e.pageY) - dash.bar_y;
						if(dash.top > 10) {
							dash.container_obj.css('top', dash.top);
						}
						// Horizontal
						if(($(window).width() / 2) >= e.pageX && dash.position == 'right') {
							dash.switchSide();
						} else if(($(window).width() / 2) <= e.pageX && dash.position == 'left') {
							dash.switchSide();
						}
					});
					
					// When mouse up remove events
					$(document).unbind('mouseup').mouseup(function() {			
						dash.bar_y = null;																						 
						$('#admin_dashboard_mask, #admin_dashboard_mask_half').hide();
						$(document).unbind('mousemove');
						dash.saveData();
					});
				}
			}
			, 500);
		});
	}
  
  /**
   * Save settings
   */
  dash.saveData = function() {
    $.ajax({
      type: "POST",
      url: Drupal.settings.admin_dashboard_base_path + "?q=admin_dashboard_ajax_save",
      data:{
        at_start:dash.at_start,
        hide_on_init:dash.hide_on_init,
				top:dash.top,
				position: dash.position 
      }
    });
  };
  
  /**
   * 
   */
  dash.animate = function(init) {
    if (init) {
      if(dash.hide_on_init == true || (dash.hide_on_init == false && dash.at_start == true)) {
        if($.browser.safari) {
          var target = (dash.position == 'left') ? {left:(0 - (dash.container_width + 24)) + 'px'} : {width:'0px'};
          dash.container_obj.animate(target, {
            complete:function() {
              dash.container_obj.css({overflow:'hidden', 'visibility':'visible'});
              dash.at_start = true;
            }
          });
        }
        else {
          var target = (dash.position == 'left') ? {left:(-24 - dash.container_width) + 'px'} : {width:'0px'};
          dash.container_obj.css(target);
          dash.container_obj.css({overflow:'hidden', 'visibility':'visible'});
          dash.at_start = true;
        };
      }
      else {
        dash.container_obj.css({'visibility':'visible'});
      };
    } else {
      var target = (dash.position == 'left') ? {left:(dash.at_start ? 0 : (-24 - dash.container_width) + 'px')} : {width: (dash.at_start ? dash.container_width : 0) + 'px'};
      dash.container_obj.animate(target, {
        complete:function() {
//          dash.container_obj.css({overflow:'hidden'});
          dash.at_start = (!dash.at_start);
          dash.saveData();
        }
      });
    };
  };

  dash.setWidth = function() {
		var tmp = $('<span />').html(dash.menu_obj.html()).css({'visibility':'hidden'}).appendTo('body');
    dash.menu_width = tmp.width() + 1;
    tmp.remove();
		if(dash.position == 'left') {
			dash.container_width = (dash.blocks_width > dash.menu_width) ? (dash.blocks_width - 24) : dash.menu_width;
			dash.content_obj.css('width', dash.container_width + "px");
		} else {
			dash.container_width = (dash.blocks_width > dash.menu_width) ? dash.blocks_width : (dash.menu_width + 24);
			dash.content_obj.css('width', (dash.container_width - 24) + "px");
		}
    dash.container_obj.css({/*overflow:'hidden',*/ width:dash.container_width});
//    dash.wrapper_obj.css({width:dash.container_width});
  };
  
  dash.init();
  return dash;
};