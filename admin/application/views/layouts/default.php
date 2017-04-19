<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Գնել ադմին</title>
        <meta name="robots" content="noindex,nofollow"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
        <meta name="author" content="Muhammad Usman">
        <!-- The styles -->
        <link href="<?php echo site_url('layout_data/css/nestedSortable.css'); ?>" rel="stylesheet">
        <link id="bs-css1" href="<?php echo site_url('layout_data/css/bootstrap-cerulean.min.css'); ?>" rel="stylesheet"> 
        <link href="<?php echo site_url('layout_data/css/bootstrap-responsive.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/charisma-app.css'); ?>" rel="stylesheet">
        <link href='<?php echo site_url('layout_data/bower_components/fullcalendar/dist/fullcalendar.css'); ?> rel='stylesheet'>
              <link href='<?php echo site_url('layout_data/bower_components/fullcalendar/dist/fullcalendar.print.css') ?> rel='stylesheet' media='print'>
              <link href="<?php echo site_url('layout_data/bower_components/chosen/chosen.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/bower_components/colorbox/example3/colorbox.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/bower_components/responsive-tables/responsive-tables.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/jquery.noty.css'); ?>" rel="stylesheet"> 
        <link href="<?php echo site_url('layout_data/css/noty_theme_default.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/elfinder.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/elfinder.theme.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/jquery.iphone.toggle.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/uploadify.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/animate.min.css'); ?>" rel="stylesheet">	
        <link href="<?php echo site_url('layout_data/css/msgboxlight.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/style.css'); ?>" rel="stylesheet">
        <link  href="<?php echo site_url('layout_data/css/print.css'); ?>" rel="stylesheet" type="text/css" media="print">
		<!-- s -->
		 <link href="<?php echo site_url('layout_data/css/jquery-ui.theme.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/jquery-ui.theme.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/jquery-ui.structure.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/jquery-ui.structure.css'); ?>" rel="stylesheet">	
        <link href="<?php echo site_url('layout_data/css/jquery-ui.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo site_url('layout_data/css/jquery-ui.css'); ?>" rel="stylesheet">
		
		<!-- s -->
        <!-- jQuery -->
        <script src="<?php echo site_url('layout_data/bower_components/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo site_url('layout_data/bower_components/jquery/jquery.form.js'); ?>"></script>
		
        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- The fav icon -->
<!--        <link rel="shortcut icon" href="img/favicon.ico">-->

    </head>

    <body>
        <!-- topbar starts -->
        <div class="navbar navbar-default" role="navigation">

            <div class="navbar-inner">
                <button type="button" class="navbar-toggle pull-left animated flip">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Gnel
<!--                    <img alt="Logo" src="--><?php //echo site_url('layout_data/img/babybuy_logo.png'); ?><!--" class="hidden-xs"/>-->
                    <span style="font-size: 15px;"></span></a>

                <!-- user dropdown starts -->
                <div class="btn-group pull-right">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"><?php echo $this->session->userdata('admin_username') ?></span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('users/personal'); ?>">Անձնական</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('logout'); ?>">Դուրս գալ</a></li>
                    </ul>
                </div>

<!--                <div class="btn-group pull-right theme-container animated tada">-->
<!--                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">-->
<!--                        <i class="glyphicon glyphicon-tint"></i><span-->
<!--                            class="hidden-sm hidden-xs"> Change Theme / Skin</span>-->
<!--                        <span class="caret"></span>-->
<!--                    </button>-->
<!---->
<!--                    <ul class="dropdown-menu" id="themes">-->
<!--                        <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>-->
<!--                        <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>-->
<!--                        <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>-->
<!--                        <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>-->
<!--                        <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>-->
<!--                        <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>-->
<!--                        <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>-->
<!--                        <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>-->
<!--                        <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>-->
<!--                    </ul>-->
<!--                </div>-->

                <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                    <li><a target="_blank" href="http://gnel.loc"><i class="glyphicon glyphicon-globe"></i>Բացել կայքը</a></li>
<!--                    <li class="dropdown">-->
<!--                        <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i>Կարգավորումներ <span-->
<!--                                class="caret"></span></a>-->
<!--                        <ul class="dropdown-menu" role="menu">-->
<!--                            <li><a href="#">Action</a></li>-->
<!--                            <li><a href="#">Another action</a></li>-->
<!--                            <li><a href="#">Something else here</a></li>-->
<!--                            <li class="divider"></li>-->
<!--                            <li><a href="#">Separated link</a></li>-->
<!--                            <li class="divider"></li>-->
<!--                            <li><a href="#">One more separated link</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <form class="navbar-search pull-left">-->
<!--                            <input placeholder="Search" class="search-query form-control col-md-10" name="query"-->
<!--                                   type="text">-->
<!--                        </form>-->
<!--                    </li>-->
                </ul>

            </div>
        </div>
        <!-- topbar ends -->
        <div class="ch-container">
            <div class="row for_height">
                <?php $this->load->view('left_menu'); ?>	
                <noscript>
                <div class="alert alert-block col-md-12">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                        enabled to use this site.</p>
                </div>
                </noscript>
                <div id="content" class="col-lg-10 col-sm-10">
                    <!-- content starts -->
                    <div>
                        <ul class="breadcrumb">
                            <li style="text-transform: capitalize;">
								<?php $ci =& get_instance(); $controller = $ci->router->fetch_class();?>
                                <a href="<?php echo site_url($controller); ?>"><?php echo $this->lang->line(ucfirst($controller)); ?></a>
                            </li>
                            
                        </ul>
                    </div>
                    <div id="content" class="span10">
                        {content}
                    </div>

                    <!-- content ends -->
                </div><!--/#content.col-md-0-->
            </div><!--/fluid-row-->



            <hr>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Settings</h3>
                        </div>
                        <div class="modal-body">
                            <p>Here settings can be configured...</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="" target="_blank">Astudio</a>  <?php echo date("Y"); ?></p>

                <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                        href="http://www.astudio.am">Astudio</a></p>
            </footer>

        </div><!--/.fluid-container-->
		
        <script>
            window.base_url = "<?php echo site_url(); ?>";
            window.frontend_url = "<?php echo $this->config->item('frontend_url'); ?>";
        </script>

        <!-- external javascript -->

        <script src="<?php echo site_url('layout_data/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

        <!-- library for cookie management -->
        <script src="<?php echo site_url('layout_data/js/jquery.cookie.js'); ?>"></script>
        <!-- calender plugin -->
        <script src='<?php echo site_url('layout_data/bower_components/moment/min/moment.min.js'); ?>'></script>
        <script src="<?php echo site_url('layout_data/bower_components/fullcalendar/dist/fullcalendar.min.js'); ?>"></script>
        <!-- data table plugin -->
        <script src="<?php echo site_url('layout_data/js/jquery.dataTables.min.js'); ?>"></script>

        <!-- select or dropdown enhancer -->
        <script src="<?php echo site_url('layout_data/bower_components/chosen/chosen.jquery.min.js'); ?>"></script>
        <!-- plugin for gallery image view -->
        <script src="<?php echo site_url('layout_data/bower_components/colorbox/jquery.colorbox-min.js'); ?>"></script>
        <!-- notification plugin -->
        <script src="<?php echo site_url('layout_data/js/jquery.noty.js'); ?>"></script>
        <!-- library for making tables responsive -->
        <script src="<?php echo site_url('layout_data/bower_components/responsive-tables/responsive-tables.js'); ?>"></script>
        <!-- tour plugin -->
        <script src="<?php echo site_url('layout_data/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js'); ?>"></script>
        <!-- star rating plugin -->
        <script src="<?php echo site_url('layout_data/js/jquery.raty.min.js'); ?>"></script>
        <!-- for iOS style toggle switch -->
        <script src="<?php echo site_url('layout_data/js/jquery.iphone.toggle.js'); ?>"></script>
        <!-- autogrowing textarea plugin -->
        <script src="<?php echo site_url('layout_data/js/jquery.autogrow-textarea.js'); ?>"></script>
        <!-- multiple file upload plugin -->
        <script src="<?php echo site_url('layout_data/js/jquery.uploadify-3.1.min.js'); ?>"></script>
        <!-- history.js for cross-browser state change on ajax -->
        <script src="<?php echo site_url('layout_data/js/jquery.history.js'); ?>"></script>
        <!-- application script for Charisma demo -->
        <script src="<?php echo site_url('layout_data/js/charisma.js'); ?>"></script>
        <script src="<?php echo site_url('layout_data/js/admin.js'); ?>"></script>
        <script src="<?php echo site_url('layout_data/js/jquery.msgBox.js'); ?>"></script>
        <script src="<?php echo site_url('layout_data/js/jquery-ui.js'); ?>"></script>
        <script src="<?php echo site_url('layout_data/js/jquery.mjs.nestedSortable.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url('editor/editor/tiny_mce.js') ?>"></script>
        <script type="text/javascript">
            tinyMCE.init({
                mode: "textareas",
                editor_selector: "mceEditor",
                height: "350px",
                theme: "advanced",
                plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars",
                theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect,|,undo,redo,|,fullscreen",
                theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor",
                theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,ltr,rtl",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true,
                relative_urls: false,
                file_browser_callback: MadFileBrowser
            });

            function MadFileBrowser(field_name, url, type, win) {
                tinyMCE.activeEditor.windowManager.open({
                    file: "<?php echo base_url(); ?>editor/mfm.php?field=" + field_name + "&url=" + url + "",
                    title: 'File Manager',
                    width: 850,
                    height: 1000,
                    resizable: "no",
                    inline: "yes",
                    close_previous: "no"
                }, {
                    window: win,
                    input: field_name
                });
                return false;
            }
        </script>
        <script src="<?php echo base_url('/ckeditor/ckeditor.js'); ?>"></script>
        <script src="<?php echo base_url('/ckeditor/adapters/jquery.js'); ?>"></script>
		
	
		
		
        <script type="text/javascript">
            $(document).ready(function() {
                $('textarea.ckEditor').ckeditor({
                    uiColor: '#9AB8F3',
                    width: 730,
                    height: 320
                });
            });
        </script>
		
		
		
	</body>
</html>
