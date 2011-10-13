<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body>

  <?php if ($primary_links): ?>
    <div id="skip-link"><a href="#main-menu"><?php print t('Jump to Navigation'); ?></a></div>
  <?php endif; ?>

  <div class="wapper"><div>

    <div class="head">
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        	<div class="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></div>
    	</a>
        <div class="search">
            <p>TÌM SỰ KIỆN</p>
            <img src="/sites/all/themes/zen/zooday/images/left-search.png" width="5" height="31" class="left" />
            <div class="line">
                <input type="text" />
            </div>
            <img src="/sites/all/themes/zen/zooday/images/right-search.png" width="5" height="31" class="left" />
            <a href="#" class="but-search"></a>           
        </div>
 
    </div><!-- /.section, /#header -->
   <div class="clear"></div>
    <!-- Banner Home -->
    <?php if($banner_home):?>
    	<?php print $banner_home?>
    <?php endif;?>

    <?php if ($title): ?>
          
        <?php endif; ?>
        <?php print $messages; ?>
        <?php if ($tabs): ?>
          <div class="tabs"><?php print $tabs; ?></div>
        <?php endif; ?>
    <?php print $help; ?>
    
     <div class="back-content-home">
		<div class="left">
			<div class="navi">
                	<ul>
						<div class="wrapclear">
							<li>
								<a href="<?php print $front_page; ?>">Zooo...day</a>
							</li>
							<li>
								<?php echo l('Sự kiện mới','eventnews');?>
							</li>
							<li>
								<?php echo l('Ca nhạc','music',array('attributes' => array('MChildren' => 'navi1')));?>
							</li>
							<li>
								<?php echo l('Phim','movies',array('attributes' => array('MChildren' => 'navi2')));?>
							</li>
							<li>
								<?php echo l('Kịch nói','story',array('attributes' => array('MChildren' => 'navi3')));?>
							</li>
							<li>
								<?php echo l('Sự kiện khác','othernews',array('attributes' => array('MChildren' => 'navi4')));?>
							</li>
						</div>
                    </ul>
					
					<!-- submenu -->
					<div class="submenu">
						<!-- navi1 -->
						<div class="each navi1">
						<?php 
						foreach (taxonomy_get_tree(3) as $value){
							?>
							<?php echo l($value->name, 'taxonomy/term/'.$value->tid);?>
							<span>|</span>
							<?php 
						}
						?>
							
						</div>
						<!-- navi1 -->
						
						<!-- navi2 -->
						<div class="each navi2">
							<?php 
						foreach (taxonomy_get_tree(2,0,-1,1) as $value){
							?>
							<?php echo l($value->name, 'taxonomy/term/'.$value->tid);?>
							<span>|</span>
							<?php 
						}
						?>
						</div>
						<!-- navi2 -->
                        
                        <!-- navi3 -->
						<div class="each navi3">
					   <?php 
					   
						foreach (taxonomy_get_tree(4) as $value){
							?>
							<?php echo l($value->name, 'taxonomy/term/'.$value->tid);?>
							<span>|</span>
							<?php 
						}
						?>
						</div>
						<!-- navi3 -->
                        
                        <!-- navi4 -->
						<div class="each navi4">
							<a href="#">Mẹ & Bé</a>
							<span>|</span>
							<a href="#">Du học</a>
							<span>|</span>
						</div>
						<!-- navi4 -->
						
					</div>
					<!-- submenu -->
            </div>
          <?php if ($is_front == TRUE){ ?>
			          <?php if($feature_film):?>
			          			<?php print $feature_film;?>
			          <?php endif;?>
			          <?php if($featured_screenplay):?>
			          			<?php print $featured_screenplay;?>
			          <?php endif;?>
			          <?php if($featured_new):?>
			          			<?php print $featured_new;?>
			          <?php endif?>
          <?php }?>
          <?php if ($is_front != TRUE){ ?>
			  <div id="content-area">
		          <?php  print $content; ?>
		      </div>
	      <?php }?>
		</div>
    	<div class="right">
    		<?php print $right_side;?>
    	</div>
        <?php // print $content_top; ?>

       <!-- <div id="content-area">
          <?php // print $content; ?>
        </div>
			-->
        <?php //print $content_bottom; ?>
		<div class="clear"></div>
    </div><!-- /#main, /#main-wrapper -->
	<div class="clear"></div>
   	<div class="footer">
       	<a href="#">ZOÔO...ĐÂY</a><span style="color:#96cfec; padding:0 15px 0 15px;">|</span><a href="#">Đăng sự kiện</a><span style="color:#96cfec; padding:0 15px 0 15px;">|</span><a href="#">Đăng quảng cáo</a><span style="color:#96cfec; padding:0 15px 0 15px;">|</span><a href="#">Điều khoản sử dụng</a><span style="color:#96cfec; padding:0 15px 0 15px;">|</span><a href="#">Về chúng tôi</a><span style="color:#96cfec; padding:0 15px 0 15px;">|</span><a href="#">Liên hệ</a>
    </div>
    <div align="right" style="margin-bottom:30px; color:#c0e2f3; font-size:11px;">© Copyright 2011 by Zoôo...đây. All rights reserved</div>

  </div></div><!-- /#page, /#page-wrapper -->
 
  <?php print $page_closure; ?>

  <?php print $closure; ?>

</body>
</html>
