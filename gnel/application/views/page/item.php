

<div id="info">
    <!--    <div class="breadcrumb"><a href="--><?php //echo site_url(); ?><!--">--><?php //echo $this->lang->line('Home'); ?><!--</a> » --><?php //echo $pages->title; ?><!--</div>-->

    <div class="row">




            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div id="left">
                    <a href="<?php echo site_url(). "page/" . $page_parrent[0]->title; ?>" class="link-page">Вернуться в раздел</a>
                    <?php if(!empty($page_childes)) { ?>
                        <?php foreach($page_childes as $item) { ?>
                        <div>
                            <a href="<?php echo site_url(). "page/".$item->title; ?>" class="link-page active"><?php echo $item->title; ?></a>
<!--                            <a href="--><?php //echo site_url(). $page_parrent[0]->title ."page/".$item->title; ?><!--" class="link-page active">--><?php //echo $item->title; ?><!--</a>-->
                        </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>


            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="col-parent" data="center">
                    <div class="text-container">
                        <h1 class="text-center"><?php echo $pages->title; ?></h1>
                        <p></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>

    </div>


</div>
