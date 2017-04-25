<div class="col-sm-11 container">
    <div class="col-xs-12 page-header padding-lr0">
        <div class="col-md-2 col-sm-6 col-xs-12  padding-lr0">
            <div class="weather"><img src="/themes/gnel/images/site-images/weather.png" /><span>+12 Yerevan<span/></div>
        </div>
        <div class="col-md-7 col-md-offset-1 col-sm-6 col-xs-12 phone text-left padding-lr0">
            <div class="pc">
                <img class="text-left" src="/themes/gnel/images/site-images/phone.png">
                <span class="text-info text-left padding-l0 padding-r0">+374 555-000, +374 000-000</span>
            </div>
            <span class="working-hours text-left padding-lr0"><?php echo $this->lang->line('working_hours'); ?> 09:00 - 22:00 PM</span>
        </div>
        <div class="col-md-1 col-sm-6 col-xs-6 text-right currency">
            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle custom" type="button" data-toggle="dropdown">AMD
                    <span class="caret"></span></button>
                <ul class="dropdown-menu custom">
                    <li><a href="#"><i class="dram">Դ</i>AMD</a></li>
                    <li><a href="#"><i class="fa fa-rub" aria-hidden="true"></i>RUB</a></li>
                    <li><a href="#"><i class="fa fa-usd" aria-hidden="true"></i>USD</a></li>
					<li><a href="#"><i class="fa fa-eur" aria-hidden="true"></i>EUR</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-1 col-sm-6 col-xs-6 flags text-right padding-lr0">
            <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle custom" type="button" data-toggle="dropdown">ARM
                <span class="caret"></span></button>
            <ul class="dropdown-menu custom">
                <li>  <a <?php echo $lang == "am" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('am'); ?>"  title="Հայերեն"><img src="/themes/gnel/images/site-images/arm.png" />
                        ARM</a></li>
                <li> <a <?php echo $lang == "ru" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('ru'); ?>"  title="Русский"><img src="/themes/gnel/images/site-images/russia.png" />
                        </i>RUS</a></li>
                <li><a <?php echo $lang == "en" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('en'); ?>"  title="English"><img src="/themes/gnel/images/site-images/britain.png" />
                        ENG</a></li>
            </ul>
            </div>
        </div>
<!--            <a --><?php //echo $lang == "am" ? 'class="selected"' : ''; ?><!-- href="--><?php //echo createMultilangUrl('am'); ?><!--"  title="Հայերեն"><img src="/themes/gnel/images/site-images/arm.png" /></a>-->
<!--            <a --><?php //echo $lang == "ru" ? 'class="selected"' : ''; ?><!-- href="--><?php //echo createMultilangUrl('ru'); ?><!--"  title="Русский"><img src="/themes/gnel/images/site-images/russia.png" /></a>-->
<!--            <a --><?php //echo $lang == "en" ? 'class="selected"' : ''; ?><!-- href="--><?php //echo createMultilangUrl('en'); ?><!--"  title="English"><img src="/themes/gnel/images/site-images/britain.png" /></a>-->

    </div>
    <div class="col-xs-12 col-sm-12 padding-lr0">
        <div class="col-xs-12 col-sm-3 col-md-3">
            <a href="<?=base_url()?>"> <img src="/themes/gnel/images/img/logo.png" class="img-responsive"></a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 media padding-l0">
            <div class="col-md-2 col-sm-3 col-xs-12">
                <div class="col-md-12 m-player padding-r0 ">
                    <div id="listContainer" class="playlistContainer">
                        <ul id="playListContainer">
                            <li data-src="/themes/gnel/audio/s.mp3"></li>
                        </ul>
                    </div>
                    <div id="playerContainer">
                        <div id="controlContainer" class="col-xs-12 text-center">
                            <ul class="controls">
                                <li>
                                    <a href="javascript:void(0);" class="left" data-attr="prevAudio"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="play" data-attr="playPauseAudio"></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="rightp" data-attr="nextAudio"></a>
                                </li>
                            </ul>
                            <div class="progress">
                                <div data-attr="seekableTrack" class="seekableTrack"></div>
                                <div class="updateProgress"></div>
                            </div>
                        </div>
                        <div class="volumeControl col-xs-12 text-center">
                            <div class="volume volume1 col-xs-1"></div>
                            <input class="bar" data-attr="rangeVolume" type="range" min="0" max="1" step="0.1" value="1" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-3 col-xs-12 banner">
                <a href="#">
                    <img src="/themes/gnel/images/site-images/banner.png">
                </a>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 v-player">
                <a href="#"><img src="/themes/gnel/images/site-images/icon-video.png"></a>
                <video class="col-md-12 padding-r0 padding-l0" id="vid">
                    <source src="/themes/gnel/videos/video.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        <div class="col-md-2 col-xs-12 login padding-lr0">
            <a href="#"><h4><?php echo $this->lang->line('registration'); ?></h4></a>
            <a href="#" class="forgot"><?php echo $this->lang->line('forgot_password'); ?></a>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control form-control-custom" name="login" placeholder="<?php echo $this->lang->line('login'); ?>" required="required" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-custom" name="password" placeholder="<?php echo $this->lang->line('Password'); ?>" required="required" />
                    <button type="submit" class="btn custom-login"><?php echo $this->lang->line('enter'); ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 menu-login padding-lr0">
        <div class="col-md-7 col-md-offset-3 col-xs-12 padding-l0">
            <div class="col-md-12 padding-l0 padding-r0 search-form">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-search" name="login" placeholder="<?php echo $this->lang->line('search'); ?>..." required="required" />
                        <a href="#" class="search"><img width="20" src="/themes/gnel/images/site-images/search.png" /></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2 col-xs-12 padding-lr0">
            <a class="col-md-12 col-xs-12 basket text-center" href="#"><span><?php echo $this->lang->line('your_basket'); ?><img width="25px" src="/themes/gnel/images/site-images/basket.png" /> (0)</span></a>
        </div>
    </div>
    <div class="col-xs-12 navbar-container navbar-container-custom padding-l0">
        <div class="col-sm-12 col-xs-12 col-md-11 padding-l0">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <nav class="navbar-collapse collapse navbar-custom" id="nav">
                <ul class="nav navbar-nav">
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle active" data-toggle="dropdown" href="#"><?php echo $this->lang->line('catalog'); ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu hidden">
                            <li><a href="#">Catalog-1</a></li>
                            <li><a href="#">Catalog-2</a></li>
                            <li><a href="#">Catalog-3</a></li>
                        </ul>
                    </li>
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->lang->line('brands'); ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu hidden">
                            <li><a href="#">Brands-1</a></li>
                            <li><a href="#">Brands-2</a></li>
                            <li><a href="#">Brands-3</a></li>
                        </ul>
                    </li>
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->lang->line('points_of_issue'); ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu hidden">
                            <li><a href="#">Points of issue-1</a></li>
                            <li><a href="#">Points of issue-2</a></li>
                            <li><a href="#">Points of issue-3</a></li>
                        </ul>
                    </li>
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->lang->line('virtual_visits'); ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu hidden">
                            <li><a href="#">Virtual visits-1</a></li>
                            <li><a href="#">Virtual visits-2</a></li>
                            <li><a href="#">Virtual visits-3</a></li>
                        </ul>
                    </li>
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $this->lang->line('news'); ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu hidden">
                            <li><a href="#">News-1</a></li>
                            <li><a href="#">News-2</a></li>
                            <li><a href="#">News-3</a></li>
                        </ul>
                    </li>
                    <li class="col-md-2 col-xs-12"><a href="<?php echo base_url('contact')?>"><?php echo $this->lang->line('Contact us'); ?></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="col-xs-12 slider-container  padding-lr0">
        <div class="delivery col-xs-12 col-sm-2  padding-lr0">
            <div class="col-md-12 padding-lr0 col-xs-10 container-left">
                <div class="text-center">
                    <a href="#">
                        <img src="/themes/gnel/images/site-images/e_delivery.png" />
                        <p><?php echo $this->lang->line('express_delivery'); ?></p>
                    </a>
                </div>
                <div class="text-center">
                    <a href="#">
                        <img src="/themes/gnel/images/site-images/r_delivery.png" />
                        <p><?php echo $this->lang->line('regular_delivery'); ?></p>
                    </a>
                </div>
                <div class="text-center expo">
                    <a href="#">
                        <img src="/themes/gnel/images/site-images/expo.png" />
                    </a>
                </div>
            </div>
        </div>
        <div class="slider col-xs-12 col-sm-10 padding-r0">
            <img class="todays" src="/themes/gnel/images/img/today-product-arm.png"> 
            <div id="slides">
                <div class="col-xs-12 padding-lr0">
                    <div class="col-xs-12 col-sm-8">
                        <img class="s-img" src="/themes/gnel/images/site-images/s.png" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
                    </div>
                    <div class="col-xs-12 col-sm-4 padding-r0">
                        <div class="col-xs-12 s-info padding-r0" >
                            <h3 class="text-right"><?php echo $this->lang->line('product_name'); ?></h3>
                            <p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <a href="#" class="see-more"><?php echo $this->lang->line('see_more'); ?>...</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 padding-lr0">
                    <div class="col-xs-12 col-sm-8">
                        <img class="s-img" src="/themes/gnel/images/site-images/s.png" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
                    </div>
                    <div class="col-xs-12 col-sm-4 padding-r0">
                        <div class="col-xs-12 s-info padding-r0" >
                            <h3 class="text-right"><?php echo $this->lang->line('product_name'); ?></h3></h3>
                            <p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <a href="#" class="see-more"><?php echo $this->lang->line('see_more'); ?>...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

