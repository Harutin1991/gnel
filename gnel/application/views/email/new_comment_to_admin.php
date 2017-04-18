<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">

    </head>
	<body>
			<div id="container" style="margin:20px;">
				<h2><?php // echo $this->lang->line('New comment'); ?></h2>
				<div style="clear:both;"></div>

				<div id="container" style="color: black; font-size:18px">

					<a href="<?php echo product_url($product['id'], $product["name_" . $this->config->item('language')]); ?>" target="_blank">
						<?php echo $product["name_" . $this->config->item('language')] . '(' . $product["brand_name"] . ' - ' . $product["code"] . ')'; ?>
					</a> 
					<br/>
					<span style="font-size=12px;"><?php echo $comment_date; ?><span>
					<br/>
					<?php echo $comment; ?>
					
				
			
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