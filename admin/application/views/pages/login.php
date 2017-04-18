<div class="well col-md-5 center login-box">
	<div class="alert alert-info">
		<?php if(isset($wrong_login)){ ?>
			<span style="color:red;">Սխալ մուտքային տվյալներ</span>
		<?php }else{ ?>
			Խնդրում ենք մուտքագրել ադմինի լոգինը և գաղտնաբառը
		<?php } ?>
	</div>
	<form class="login_form" action="" method="post">
		<fieldset>
			<div class="input-group input-group-lg">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
				<input type="text" class="form-control" name="admin_username" placeholder="Լոգին">
			</div>
			<div class="clearfix"></div><br>

			<div class="input-group input-group-lg">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
				<input type="password" name="admin_password" class="form-control" placeholder="Գաղտնաբառ">
			</div>
			<div class="clearfix"></div>
			<div class="clearfix"></div>
			<p class="center col-md-5">
				<button type="submit" name="admin_login" class="btn btn-primary">Login</button>
			</p>
		</fieldset>
	</form>
</div>
<!--/span-->