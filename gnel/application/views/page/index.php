

<div id="content">
    <div class="breadcrumb"><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <?php echo $page->title; ?></div>

    <div class="col-sm-12">
        <div class="col-sm-6">
            <div class="information_content">
                <?php if($page->image != '' ) {?>
                    <div class="imageborder"><img src="<?php echo pageImg($page->id, $page->image)?>" alt="<?php echo $page->title; ?>"></div>
                <?php } ?>

                <?php echo $page->text; ?>

            </div>

        </div>
        <div class="col-sm-6">

        </div>
    </div>
    <div class="col-sm-12">

    </div>
    <h1><span class="h1-top"><?php echo $page->title; ?></span></h1>

</div>