<div id="content">

    <div class="breadcrumb"><a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?> » <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a> » <a href="#"><?php echo $this->lang->line('Edit'); ?></a> </div>
    <h1><span class="h1-top"> <?php echo $this->lang->line('Edit Account'); ?></span></h1>
    <div class="my-account">
      <form action="" method="post" enctype="multipart/form-data">
        <h2><?php echo $user['email']; ?></h2>
        <div class="content">
          <table class="form">
            <tbody>
           	  <tr>
                <td class="desc"><span class="required">*</span> <?php echo $this->lang->line('First Name:'); ?></td>
				<td rowspan="6">
					<?php $img_url = $user['image'] != '' ? base_url('images/users/' . $user['id'] .'/'. $user['image'])  : base_url('images/icons/user-add-icon.png'); ?>
					<label class="control-label" for="image" ><?php echo $this->lang->line('Chose image'); ?></label>
					<input name="image" value="" type="file"  id="image" class="hide">
					<h4 class="add_img"><?php echo $this->lang->line('Add image'); ?></h4>
					<div class="imageborder">
						<img src="<?php echo $img_url; ?>" alt="User image" id="user_image"/>
						<img src="/images/icons/change_img.png" alt="User image change" id="user_image_change" title="<?php echo $this->lang->line('change'); ?>"/>
						<img src="/images/icons/delete_img.png" alt="User image delete" id="user_image_delete" title="<?php echo $this->lang->line('delete'); ?>"/>
					</div>
				</td>	
              </tr>
              <tr>
				<?php $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : $user['first_name']; ?>
                <td class="txtinput"><input type="text" name="first_name" value="<?php echo $first_name; ?>" required="required"></td>
              </tr>
              <tr>
                <td class="desc"><span class="required"></span> <?php echo $this->lang->line('Last Name:'); ?></td>
              </tr>
              <tr>
				<?php $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : $user['last_name']; ?>
                <td class="txtinput"><input type="text" name="last_name" value="<?php echo $last_name; ?>" ></td>
              </tr>
              <tr>
                <td class="desc"><span class="required"></span> <?php echo $this->lang->line('Phone'); ?><?php echo $this->lang->line(':'); ?></td>
              </tr>
              <tr>
				<?php $phone = isset($_POST['phone']) ? $_POST['phone'] : $user['phone']; ?>
                <td class="txtinput"><input type="text" name="phone" value="<?php echo $phone; ?>"  ></td>
              </tr>
              <tr>
		  
			  </tr>
            </tbody>
		  </table>
        </div>
		<div class="notification pass_note">
			<?php if(isset($update_error)) { ?>
				<?php echo $this->lang->line('Please try again'); ?>
			<?php } ?>
			<?php if(isset($update_success)) { ?>
				<p class='success'><?php echo $this->lang->line('Account updated successfully'); ?></p>
			<?php } ?>
		</div>
        <div class="buttons">
          <div class="right smaller right_add_img">
            <input type="submit" value="<?php echo $this->lang->line('Confirm'); ?>" name="update_account" class="button button_add_img">
          </div>
        </div>
      </form>
    </div>
  </div> 
  
  <script>
	jQuery(document).ready(function(){

        $('#user_image_change').click(function() {
            $('#image').click();
        });

        $('#image').bind("change", function(e) {
            readURL(this);
        });
		 $('#user_image').click(function() {
            $('#image').click();
        });

        $('#image').bind("change", function(e) {
            readURL(this);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#user_image").attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	});
  </script>