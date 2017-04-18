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
        <?php if(isset($fb_url)){ ?>
			<meta property="og:url" content="<?php echo $fb_url; ?>"/>
		<?php } else {?>
            <meta property="og:url" content="<?php echo base_url(); ?>"/>
        <?php } ?>
		<?php if(isset($fb_image)){ ?>
			<meta property="og:image" content="<?php echo $fb_image; ?>"/>
        <?php } else {?>
            <meta property="og:image" content="<?php echo base_url('themes/babybuy/image/babybuy_logo.png'); ?>"/>
		<?php } ?>
		<?php if(isset($fb_title)){ ?>
			<meta property="og:title" content="<?php echo $fb_title; ?>"/>
        <?php } else {?>
            <meta property="og:title" content="<?php echo 'Մանկական օնլայն խանութ'; ?>"/>
		<?php } ?>
		<?php if(isset($fb_description)){ ?>
			<meta property="og:description" content="<?php echo $fb_description; ?>" />
		<?php } else {?>		
			<meta property="og:description" content="Կայքում ներկայացված են լավագույն մանկական բրենդները: All kids brands in one awesome site." />
		<?php } ?>			
		<!-- END for Facebook -->
		
		<link rel="alternate" href="babybuy.am" hreflang="hy-am" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Gochi+Hand">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/babybuy/css/JivoSite.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/babybuy/css/magnific-popup.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/babybuy/css/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/babybuy/css/main.css?<?php echo filectime('themes/babybuy/css/main.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/babybuy/css/media.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>themes/babybuy/css/style_<?php echo $this->config->item('language'); ?>.css">
        <link rel="shortcut icon" href="<?php echo base_url('images/icons/favicon.ico'); ?>">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="BabyBuy">
        <meta name="format-detection" content="telephone=no">
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-icon-152x152.png" />
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-icon-precomposed.png" />
        <link rel="shortcut icon" sizes="152x152" href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-icon-152x152.png" />
        <link href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-startup-image-1536x2008.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-startup-image-1496x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-startup-image-768x1004.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image" />
        <link href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-startup-image-748x1024.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image" />
        <link href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-startup-image-640x1096.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-startup-image-640x920.png" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
        <link href="<?php echo base_url(); ?>themes/babybuy/app-images/apple-touch-startup-image-320x460.png" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image" />

        <script type="text/javascript" src="<?php echo base_url(); ?>themes/babybuy/js/lib/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>themes/babybuy/js/lib/jquery.cookie.js"></script>
        <script>
            window.base_url = "<?php echo base_url(); ?>";
            window.site_url = "<?php echo site_url(); ?>";
            window.language = "<?php echo $this->config->item('language'); ?>";
            window.currency = "<?php echo $this->lang->line('AMD'); ?>";
            window.sale     = "<?php echo $this->lang->line('Sale'); ?>";
        </script>

    </head>