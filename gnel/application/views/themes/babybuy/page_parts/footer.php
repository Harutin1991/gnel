<div id="footer">
  <div id="footer_top">
    <div class="footer_wrapper">
      <div id="footer_top_content">
        <div id="footer_top_item">
          <div class="footer_top_item" id="about_us">
            <span class="icon"><i class="fa fa-search fa-fw"></i></span><h3 class="title_item_1"><?php echo $this->lang->line('About us'); ?></h3>
            <div class="text_item">
			<?php echo $this->lang->line('About us text'); ?>
            </div>
          </div>
          <div class="footer_top_item" id="contact_us">
            <span class="icon"><i class="fa fa-envelope fa-fw"></i></span><h3 class="title_item_2"><?php echo $this->lang->line('Contact us'); ?></h3>
            <div class="text_item">
              
             
              <p class="online_contact">
              <i class="fa fa-mobile-phone fa-fw"></i>&nbsp;+374 - 93 665 305<br />
              <i class="fa fa-mobile-phone fa-fw"></i>&nbsp;+374 - 99 665 305<br />
              <i class="fa fa-envelope fa-fw"></i>&nbsp;<a class="color" href="mailto:babybuy.am@gmail.com" title="Mail">babybuy.am@gmail.com</a>
              </p>
            </div>
          </div>
          <div class="footer_top_item " id="twitter_news">
            <span class="icon"><i class="fa fa-twitter fa-fw"></i></span><h3 class="title_item_3" >Twitter Feed</h3>
            <div class="text_item">
              <div id="twitter_update_list">
					<a class="twitter-timeline" height="250" data-chrome="nofooter noheader transparent noscrollbar" data-tweet-limit="2" href="https://twitter.com/babybuyam"  data-widget-id="564761187158482945"></a>
              </div>
            </div>
          </div>
          <div class="footer_top_item last_footer_item" id="facebook">
            <span class="icon"><i class="fa fa-facebook fa-fw"></i></span><h3 class="title_item_4">Facebook</h3>
            <div class="text_item">  
			
            <div class="fb-like-box" data-href="https://www.facebook.com/pages/babybuyam/343918929043210?ref=hl" 
                                     data-width="220" 
                                     data-height="250" 
                                     data-show-faces="true" 
                                     data-stream="false" 
                                     data-show-border="false" 
                                     data-header="false"
                                     data-hide-cover="true"
									 data-share="true"></div>
            </div>
            <div id="fb-root"></div> 
			
			<!--
			<div class="fb-page" data-href="https://www.facebook.com/babybuy.am" 
								data-small-header="true" 
								data-width="220" 
                                data-height="250" 
								data-adapt-container-width="true" 
								data-hide-cover="true" 
								data-show-facepile="true" 
								data-show-posts="false">
				<div class="fb-xfbml-parse-ignore">
					<blockquote cite="https://www.facebook.com/babybuy.am">
						<a href="https://www.facebook.com/babybuy.am">Babybuy.am</a>
					</blockquote>
				</div>
			</div>
			-->
			
			
			
			
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer_wrapper">
    <div id="footer_bottom">
      <div class="footer_bottom_item">
        <h3 class="bottom_item_1 down"><a><?php echo $this->lang->line('Information'); ?></a></h3>
		<?php echo drawMenu($menu['Information'], array("class" => "menu_footer_item text_item")); ?>
      </div>
      <div class="footer_bottom_item">
        <h3 class="bottom_item_2 down"><a><?php echo $this->lang->line('Customer Service'); ?></a></h3>
		<?php echo drawMenu($menu["Customer Service"], array("class" => "menu_footer_item text_item")); ?>
      </div>
	
      <div class="footer_bottom_item">
        <h3 class="bottom_item_3 down"><a><?php echo $this->lang->line('Extras'); ?></a></h3>
		<?php echo drawMenu($menu["Extras"], array("class" => "menu_footer_item text_item")); ?>

      </div>
        
      <div class="footer_bottom_item">
        <h3 class="bottom_item_4 down"><a><?php echo $this->lang->line('My Account'); ?></a></a></h3>
		<?php  // echo drawMenu($menu["My Account"], array("class" => "menu_footer_item text_item")); ?>
        <ul class="menu_footer_item text_item">
		  <? if(isset($logged) && $logged) { ?>
			<li><a href="<?php echo site_url('account/logout'); ?>"><?php echo $this->lang->line('Exit'); ?></a></li>
		  <?php } else { ?>
            <li><a href="<?php echo site_url('account/register'); ?>"><?php echo $this->lang->line('Register'); ?></a></li>
			<li><a href="<?php echo site_url('account/login'); ?>"><?php echo $this->lang->line('Login'); ?></a></li>
		  <?php } ?>
        </ul>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div id="footer-text">
    <p>&#169; 2015 <?php echo $this->lang->line('All rights reserved'); ?> 


	<span class="powered">
	Powered by 
	 <span>
	  <a href="http://esterox.am/"  target="blank" ><img src="<?php echo base_url('images/icons/esterox.png'); ?>"> Esterox</a>
	 </span>
	 </span>
	</p>
 
	
  </div>
  
</div>