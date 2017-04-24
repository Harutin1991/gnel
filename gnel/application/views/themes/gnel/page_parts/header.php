<div class="col-sm-11 container">
    <div class="col-xs-12 page-header padding-lr0">
        <div class="col-md-2 col-sm-6 col-xs-12  padding-lr0">
            <div class="weather"><img src="/themes/gnel/images/site-images/weather.png" /> <span>+12 Yerevan<span/></div>
        </div>
        <div class="col-md-6 col-md-offset-1 col-sm-6 col-xs-12 phone text-left padding-lr0">
            <div class="pc">
                <img class="text-left" src="/themes/gnel/images/site-images/phone.png">
                <span class="text-info text-left padding-l0 padding-r0">+374 555-000, +374 000-000</span>
            </div>
            <span class="working-hours text-left padding-lr0"> working hours 09:00 - 22:00 PM</span>
        </div>
        <div class="col-md-1 col-sm-6 col-xs-6 text-right currency">
            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle custom" type="button" data-toggle="dropdown">RUB
                    <span class="caret"></span></button>
                <ul class="dropdown-menu custom">
                    <li><a href="#">RUB</a></li>
                    <li><a href="#">USD</a></li>
                    <li><a href="#">AMD</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6 flags text-right padding-lr0">
            <a <?php echo $lang == "am" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('am'); ?>"  title="Հայերեն"><img src="/themes/gnel/images/site-images/arm.png" /></a>
            <a <?php echo $lang == "ru" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('ru'); ?>"  title="Русский"><img src="/themes/gnel/images/site-images/russia.png" /></a>
            <a <?php echo $lang == "en" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('en'); ?>"  title="English"><img src="/themes/gnel/images/site-images/britain.png" /></a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 padding-lr0">
        <div class="col-xs-12 col-sm-12 col-md-7 col-md-offset-3 media padding-l0">
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
                                    <a href="#" class="left" data-attr="prevAudio"></a>
                                </li>
                                <li>
                                    <a href="#" class="play" data-attr="playPauseAudio"></a>
                                </li>
                                <li>
                                    <a href="#" class="rightp" data-attr="nextAudio"></a>
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
            <a href="#"><h4>Registration</h4></a>
            <a href="#" class="forgot">forgot password</a>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control form-control-custom" name="login" placeholder="login" required="required" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-custom" name="password" placeholder="password" required="required" />
                    <button type="submit" class="btn custom-login">ENTER</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 menu-login padding-lr0">
        <div class="col-md-7 col-md-offset-3 col-xs-12 padding-l0">
            <div class="col-md-12 padding-l0 padding-r0 search-form">
                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-search" name="login" placeholder="search..." required="required" />
                        <a href="#" class="search"><img width="20" src="/themes/gnel/images/site-images/search.png" /></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2 col-xs-12 padding-lr0">
            <a class="col-md-12 col-xs-12 basket text-center" href="#"><span>Your basket <img width="25px" src="/themes/gnel/images/site-images/basket.png" /> (0)</span></a>
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
                        <a class="dropdown-toggle active" data-toggle="dropdown" href="#">Catalog
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Catalog-1</a></li>
                            <li><a href="#">Catalog-2</a></li>
                            <li><a href="#">Catalog-3</a></li>
                        </ul>
                    </li>
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Brands
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Brands-1</a></li>
                            <li><a href="#">Brands-2</a></li>
                            <li><a href="#">Brands-3</a></li>
                        </ul>
                    </li>
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Points of issue
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Points of issue-1</a></li>
                            <li><a href="#">Points of issue-2</a></li>
                            <li><a href="#">Points of issue-3</a></li>
                        </ul>
                    </li>
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Virtual visits
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Virtual visits-1</a></li>
                            <li><a href="#">Virtual visits-2</a></li>
                            <li><a href="#">Virtual visits-3</a></li>
                        </ul>
                    </li>
                    <li class="dropdown col-md-2 col-xs-12">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">News
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">News-1</a></li>
                            <li><a href="#">News-2</a></li>
                            <li><a href="#">News-3</a></li>
                        </ul>
                    </li>
                    <li class="col-md-2 col-xs-12"><a href="#">Contacts</a></li>
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
                        <p>Express Delivery</p>
                    </a>
                </div>
                <div class="text-center">
                    <a href="#">
                        <img src="/themes/gnel/images/site-images/r_delivery.png" />
                        <p>Regular Delivery</p>
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
            <img class="todays" src="/themes/gnel/images/site-images/t.png">
            <div id="slides">
                <div class="col-xs-12 padding-lr0">
                    <div class="col-xs-12 col-sm-8">
                        <img class="s-img" src="/themes/gnel/images/site-images/s.png" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
                    </div>
                    <div class="col-xs-12 col-sm-4 padding-r0">
                        <div class="col-xs-12 s-info padding-r0" >
                            <h3 class="text-right">Product name</h3>
                            <p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and</p>
                            <a href="#" class="see-more">See more...</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 padding-lr0">
                    <div class="col-xs-12 col-sm-8">
                        <img class="s-img" src="/themes/gnel/images/site-images/s.png" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
                    </div>
                    <div class="col-xs-12 col-sm-4 padding-r0">
                        <div class="col-xs-12 s-info padding-r0" >
                            <h3 class="text-right">Product name</h3>
                            <p>orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and</p>
                            <a href="#" class="see-more">See more...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

