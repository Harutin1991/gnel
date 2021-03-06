<!DOCTYPE html>
<html dir="ltr" lang="<?php echo $this->config->item('language') === 'am' ? 'hy' :  $this->config->item('language'); ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui, user-scalable=no">
        <title><?php echo isset($meta_title) && $meta_title != '' ? $meta_title : $this->lang->line('default_meta_title'); ?></title>
        <meta name="description" content="<?php echo isset($meta_description) && $meta_description != '' ? $meta_description : $this->lang->line('default_meta_description'); ?>">
        <meta name="keywords" content="<?php echo isset($meta_keywords) && $meta_keywords != '' ? $meta_keywords : $this->lang->line('default_meta_keywords');; ?>">
		<!-- START for Facebook -->
        <meta property="og:type" content="article" />
        <meta property="og:locale" content="en_US" />            <!-- Default -->
        <meta property="og:locale:alternate" content="hy_AM" />  <!-- French -->
        <meta property="og:locale:alternate" content="it_IT" />
		<!-- END for Facebook -->
		
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Gochi+Hand">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/slick.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/slick-theme.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/example.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/player.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/font-awesome.min.css">
<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--themes/gnel/css/custom.css">-->

<!--        <link rel="stylesheet" type="text/css" href="--><?php //echo base_url(); ?><!--themes/gnel/css/stylesheet.css">-->
        <link rel="icon" href="<?php echo base_url(); ?>themes/gnel/images/faveicon.png" type="image/gif" sizes="16x16">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/main.css?<?php echo filectime('themes/gnel/css/main.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/gnel/css/style_<?php echo $this->config->item('language'); ?>.css">
        <link rel="shortcut icon" href="<?php echo base_url('images/icons/favicon.ico'); ?>">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="gnel">
        <meta name="format-detection" content="telephone=no">


        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/lib/jquery.cookie.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/lib/slick.min.js"  charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/lib/bootstrap.min.js"  charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/lib/jquery.audioControls.min.js"  charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/lib/jquery.dataTables.min.js"  charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/lib/dataTables.bootstrap.min.js"  charset="utf-8"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/gnel/js/lib/jquery.slides.min.js"  charset="utf-8"></script>
			


        <script>
            window.base_url = "<?php echo base_url(); ?>";
            window.site_url = "<?php echo site_url(); ?>";
            window.language = "<?php echo $this->config->item('language'); ?>";
            window.currency = "<?php echo $this->lang->line('AMD'); ?>";
            window.sale     = "<?php echo $this->lang->line('Sale'); ?>";
        </script>

        <?php if($lang == 'am') { ?>
            <style>
                @font-face {
                    font-family: 'GHEAGrpalatReg';
                    src: url(<?php echo base_url(); ?>themes/gnel/fonts/GHEAGrpalatReg.otf);
                    font-weight: normal;
                    font-style: normal;
                }
                body {
                    font-family: 'GHEAGrpalatReg';
                }
            </style>
        <?php } else {?>
            <style>
                @font-face {
                    font-family: 'Roboto';
                    src: url(<?php echo base_url(); ?>themes/gnel/fonts/roboto/Regular/Roboto-Regular.ttf);
                    font-weight: normal;
                    font-style: normal;
                }
                body {
                    font-family: 'Roboto';
                }
            </style>
        <?php } ?>



    </head>