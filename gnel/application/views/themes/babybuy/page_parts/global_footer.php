
</div>

<?php $this->load->view('themes/babybuy/page_parts/footer.php'); ?>

</div>
</div>
<?php $this->load->view('themes/babybuy/page_parts/snap-drawers.php'); ?>

</div>
<?php $this->load->view('themes/babybuy/page_parts/call.php'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>themes/babybuy/js/lib/plugins.min.js"></script>
<script type="text/JavaScript" src="<?php echo base_url(); ?>themes/babybuy/js/custom.js"></script>
<script type="text/JavaScript" src="<?php echo base_url(); ?>themes/babybuy/js/main.js?<?php echo filectime('themes/babybuy/js/main.js'); ?>"></script>
<script type="text/JavaScript" src="<?php echo base_url(); ?>themes/babybuy/js/jquery.magnific-popup.min.js"></script>
<!--[if lt IE 8]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- RedHelper -->
<!--<script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
        src="https://web.redhelper.ru/service/main.js?c=babybuy">
</script> -->
<!--/Redhelper -->


<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function() {
        var widget_id = '99740';
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + '//code.jivosite.com/script/widget/' + widget_id;
        var ss = document.getElementsByTagName('script')[0];
        ss.parentNode.insertBefore(s, ss);
    })();
</script>

<!-- {/literal} END JIVOSITE CODE --> 

<!--chat help -->

<!--<script type="text/javascript">var CHelp;(function(){var d=document,s=d.createElement("script"),c=d.getElementsByTagName("script"),a=c[c.length-1],h=d.location.protocol;s.src="http://cdn.chathelp.ru/js.min/ch-base.js";s.type="text/javascript";s.async=1;a.parentNode.insertBefore(s,a); s.onload = function(){var siteId = "55409c44a224cc7a2db09dd2";CHelp = new ChatHelpJS(siteId);}})()
</script>-->
<!--chat help -->



<!--GOOGLE ANALYTICS -->
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-38736802-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>
<!--GOOGLE ANALYTICS -->


</body>
</html>