<div class="film">
	<div class="tab">
		<div class="wrapclear top">
	        <div class="left"></div>
	        <div class="mid"><strong><?php echo $type;?></strong></div>	
	        <div class="right"></div>
	    </div>
	    <div class="top-box"></div>
	    <div class="mid-box">
	    	<div class="wrapclear">
	    		<?php foreach ($list as $key=>$value) {?>
						<div class="item-film">

			                    <div class="thum">
			                        <?php echo l(theme_imagecache('132x107', $value->field_hinh_dai_dien[0]['filepath']),'node/'.$value->nid,array('html'=>true));?>
			                        <div class="mask">
			                            <table width="132" height="28">
			                                <tr>
			                                    <td align="center" valign="middle">
			                                        <?php echo l($value->title,'node/'.$value->nid);?>
			                                    </td>
			                                </tr>
			                            </table>
			                        </div>
			                    </div>
			              <?php echo l('lịch diễn','node/'.$value->nid,array('attributes' => array('class' => 'showtime')));?>

			            </div>
	    		<?php }?>
	        </div>
	    </div>
	    <div class="bot-box"></div>
	</div>
</div>
