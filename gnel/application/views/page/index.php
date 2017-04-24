

<div id="content">
<!--    <div class="breadcrumb"><a href="--><?php //echo site_url(); ?><!--">--><?php //echo $this->lang->line('Home'); ?><!--</a> » --><?php //echo $pages->title; ?><!--</div>-->

    <div class="row">
        <h1 class="text-center"><?php echo $pages->title; ?></h1>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-parent" data="center"><div class="text-container"><h2 class="text-center no-margin"><a href="/terms-of-use/pravila-torgovoy-ploschadki/">Правила торговой площадки</a></h2><p></p></div><div class="clearfix"></div></div>
        <div class="clearfix"></div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-parent" data="center"><div class="text-container"><h2 class="text-center no-margin"><a href="/terms-of-use/publichnaya-oferta/">Публичная оферта</a></h2><p></p></div><div class="clearfix"></div></div>
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-parent" data="center"><div class="text-container"><h2 class="text-center no-margin"><a href="/terms-of-use/otkaz-ot-otvetstvennosti/">Отказ от ответственности</a></h2><p></p></div><div class="clearfix"></div></div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="col-sm-6">
            <div class="information_content">
                <?php if($pages->image != '' ) { ?>
                    <div class="imageborder"><img src="<?php echo pagesImg($pages->id, $pages->image)?>" alt="<?php echo $pages->title; ?>"></div>
                <?php } ?>

                <?php echo $pages->text; ?>

            </div>

        </div>
        <div class="col-sm-6">

        </div>
    </div>
    <div class="col-sm-12">

    </div>
    <h1><span class="h1-top"><?php echo $pages->title; ?></span></h1>

</div>