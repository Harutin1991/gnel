<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">

    </head>
	<body>
			<div id="container" style="margin:20px;">

					<header style="color: #205e75; font-size:40px; overflow:hidden;">
				                        <div id="logo" style="float:left;">
                            <a href="http://new.babybuy.am/">
                                <img style="width:120px; margin-right:30px;" src="http://new.babybuy.am/themes/babybuy/image/babybuy_logo.png" title="babybuy" alt="logo">
                            </a>
                        </div>
				   <br/>

						<div  style="float:left; font-size:30px; line-height: auto; margin-top:10px;">
								Մանկական օնլայն խանութ<center style="margin-top:22px;">babybuy.am</center>
						</div>
				</header>
				<div style="clear:both;"></div>

				<div id="container" style="color: black; font-size:18px">
					

					<br/>
				
					 <?php echo $this->lang->line('Got to this link to activate your account:'); ?> <span style="color: red;"><a href="<?php echo site_url('account/activate/'.$code); ?>"><?php echo $this->lang->line('activate'); ?></a></span>
			
			</div>
			<br/>
			<br/>
			<br/>
			<footer style="color:#205e75; text-align:right;">
			<div style="text-align:right; font-size:18px; padding-right:30px; line-height:1.25;">
              +374 - 93 665 305<br>
              +374 - 99 665 305<br>
              <a style="color:#205e75;" href="mailto:babybuy.am@gmail.com" title="Mail">babybuy.am@gmail.com</a>
			  
            </div>
			</footer>
		</div>
	</body>
</html>