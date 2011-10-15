$(function() {
	var objMenu = $(".back-content-home .navi, .back-content-subpage .navi");
	if(objMenu.length) {
		var temp;
		objMenu.find("ul li a").each(function() {
			var className = $(this).attr("MChildren");
			
			$(this).mouseenter(function() {
				clearTimeout(temp);
				$(".navi a").removeClass("active");

				if(objMenu.find(".submenu .each." + className).length) {
					objMenu.find(".submenu .each").hide();
					objMenu.find(".submenu .each." + className).show();
					objMenu.find(".submenu").stop(true, true).show("fast");
				}
				else {
					objMenu.find(".submenu").stop(true, true).hide("fast");
				}
			}).mouseleave(function() {
				temp = setTimeout(function() {
					var objMenuActive = objMenu.find("ul li a.active1");
					
					$(this).removeClass("active");
					objMenu.find(".submenu .each").hide();
					
					if(objMenuActive.length) {
						objMenuActive.addClass("active");
						var className1 = objMenuActive.attr("MChildren");
						objMenu.find(".submenu .each." + className1).show();
						objMenu.find(".submenu").stop(true, true).show("fast");
					}
					else {
						$(".submenu").stop(true, true).hide("fast");
					}
				}, 300);
			});
			objMenu.find(".submenu").mouseenter(function() {
				$(this).find(".each").each(function() {
					var isBlock = $(this).css("display") == "block" ? true : false;
					if(isBlock) {
						var className = $(this).attr("class").replace("each ", "");
						$(".navi a").removeClass("active");
						$(".navi a").each(function() {
							if($(this).attr("MChildren") == className) $(this).addClass("active");
						});
					}
				});
				clearTimeout(temp);
				$(".submenu").stop(true, true).show("fast");
			}).mouseleave(function() {
				$(".navi a").removeClass("active");
				
				var objMenuActive = objMenu.find("ul li a.active1");
				if(objMenuActive.length) {
					objMenuActive.addClass("active");
					
					var className1 = objMenuActive.attr("MChildren");
					objMenu.find(".submenu .each").hide();
					objMenu.find(".submenu .each." + className1).show();
				}
				else {
					$(".submenu").stop(true, true).hide("fast");
				}
			});
			objMenu.find(".submenu .each").mouseenter(function() {
				var className = $(this).attr("class").replace("each ", "");
				$(".navi a").removeClass("active");
				$(".navi a").each(function() {
					if($(this).attr("MChildren") == className) $(this).addClass("active");
				});
			});
			
			var active = $(this).hasClass("active1");
			if(active) {
				$(this).addClass("active");
				objMenu.find(".submenu .each").hide();
				objMenu.find(".submenu .each." + className).show();
				objMenu.find(".submenu").stop(true, true).show("fast");
			}
		});
	}
	
	$(".film .tab .item-film .thum").hover(function(){
		$(this).find('.mask').hide()
	},function(){
		$(this).find('.mask').show()
	})
});