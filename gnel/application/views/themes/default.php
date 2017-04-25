<html lang="en">
<head>
    <title><?php echo $title; ?></title>
	<meta name="robots" content="noindex,nofollow"> 
    <meta charset="utf-8">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>themes/default/img/favicon.png" type="image/x-icon"/>
    <link href="<?php echo base_url(); ?>themes/default/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>themes/default/css/bootswatch.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>themes/default/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/default/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>themes/default/js/bootswatch.js"></script>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo site_url(); ?>" class="navbar-brand">Astudio</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('site/index'); ?>">Home</a></li>
            <li><a href="<?php echo site_url('site/contacts'); ?>">Contact Us</a></li>
            <li><a href="<?php echo site_url('site/about'); ?>">About Us</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Languages <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="download">
                <li><a href="<?php echo createMultilangUrl('am'); ?>"><?php echo $languages['am']; ?></a></li>
                <li><a href="<?php echo createMultilangUrl('en'); ?>"><?php echo $languages['en']; ?></a></li>
                <li><a href="<?php echo createMultilangUrl('ru'); ?>"><?php echo $languages['ru']; ?></a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>

  <div class="container">
  
  <div class="row">
      <?php echo $output; ?>
      <?php echo $this->load->get_section('sidebar'); ?>
  </div>
    <hr/>

    <footer>
      <div class="row">
          <div class="span6 b10">
              Copyright &copy; <a target="_blank" href="https://plus.google.com/u/0/107789497808468736690?rel=author">John Skoumbourdis</a> | <a target="_blank" href="http://www.web-and-development.com">www.web-and-development.com</a>
          </div>
      </div>
    </footer>

  </div> <!-- /container -->
</body>
</html>
