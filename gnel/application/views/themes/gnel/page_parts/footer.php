<div class="col-sm-11 container">
    <div class="col-xs-12 footer-container padding-lr0">
        <div class="col-sm-3 col-xs-12 l-f-menu text-center padding-l0">
            <div class="col-md-12 evaluate text-center padding-lr0">
                <p><i><?php echo $this->lang->line('evaluate_the_quality_of_service'); ?></i></p>
                <div class="star-rating hidden">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-empty"></i>
                    <i class="fa fa-star-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
				<div class="vote">
					<div class="rating">
						<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
						<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
						<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
						<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
						<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
					</div>
				</div>
            </div>
            <div class="col-md-12 porposals text-center padding-lr0">
                <p><i><?php echo $this->lang->line('proposals_and_complaints'); ?></i></p>
                <p><span><?php echo $this->lang->line('hot_line'); ?></span> +374 91 000 000</p>
            </div>
            <div class="col-md-12 cards text-center padding-lr0">
                <img src="/themes/gnel/images/site-images/cards.png" / >
            </div>
        </div>

        <div class="col-sm-9 col-xs-12 footer-menu">
            <div class="fm">

<!--                --><?php //echo print_r($page); die; ?>

                <?php $standartMenu = drawMenu($page, array("class" => "col-sm-3 col-xs-6"), 6);

                if($standartMenu['count'] <= 3 ) { ?>
                    <?=$standartMenu['html'] ;?>
                        <li><a href="<?php echo base_url('faq')?>"><?php echo $this->lang->line('faq'); ?></a></li>
                        <li><a href="<?php echo base_url('blog')?>"><?php echo $this->lang->line('our_blog'); ?></a></li>
                        <li><a href="<?php echo base_url('contact')?>"><?php echo $this->lang->line('Contact us'); ?></a></li>
                    </ul>
                <?php  }else{ ?>
                    <?=$standartMenu ['html'] ; ?>
                    <ul class="col-sm-3 col-xs-6">
                        <li><a href="<?php echo base_url('faq')?>"><?php echo $this->lang->line('faq'); ?></a></li>
                        <li><a href="<?php echo base_url('blog')?>"><?php echo $this->lang->line('our_blog'); ?></a></li>
                        <li><a href="<?php echo base_url('contact')?>"><?php echo $this->lang->line('Contact us'); ?></a></li>
                    </ul>
                <?php  } ?>



            </div>
        </div>
    </div>
    <div class="col-xs-12 design padding-lr0">

        <div class="col-xs-12 col-sm-6 text-left" style="padding: 0">
            <div class="col-xs-12 col-sm-12 text-left social_icon">
                <a href="https://www.facebook.com/" target="_blank"><img src="/themes/gnel/images/social/fb.png"></a>
				<a href="https://vk.com/" target="_blank"><img src="/themes/gnel/images/social/vk.png"></a>
				<a href="https://www.instagram.com/" target="_blank"><img src="/themes/gnel/images/social/instagram.png"></a>
				<a href="https://www.youtube.com/" target="_blank"><img src="/themes/gnel/images/social/youtube.png"></a>
				<a href="https://twitter.com/?lang=ru" target="_blank"><img src="/themes/gnel/images/social/twiter.png"></a>
				<a href="https://plus.google.com/collections/featured" target="_blank"><img src="/themes/gnel/images/social/gplus.png"></a>
<!--				<a href="https://ok.ru/" target="_blank"><img src="/themes/gnel/images/social/ok.png"></a>-->
<!--				<a href="view-source:http://gnel-front.atalyanstudio.am/" target="_blank"><img src="/themes/gnel/images/social/rss.png"></a>-->
            </div>
        </div>

<!--        <p class="col-xs-12 col-sm-6 text-left padding-lr0">-->
<!--            <i>made in Armenia</i>-->
<!--        </p>-->

        <p class="col-xs-12 col-sm-6 text-right padding-lr0 company">
            <i><a href="http://astudio.am/" target="_blank" title="Design and development">Design and development by</a> ASTUDIO</i>
        </p>
    </div>
</div>

<!--<div class="support"><p>On-line SUPPORT</p></div>-->
