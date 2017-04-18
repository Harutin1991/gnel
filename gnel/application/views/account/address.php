<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a> » <a href="#"><?php echo $this->lang->line('Address'); ?></a> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Address Book'); ?></span></h1>
    <div class="information_content">
		<form action="" method="post" enctype="multipart/form-data">
			<h2><?php echo $this->lang->line('Edit Address'); ?></h2>
			<div class="content">
				<table class="form">
					<tbody>
						<tr>
							<td class="desc"><span class="required">*</span> <?php echo $this->lang->line('Country'); ?> <?php echo $this->lang->line(':'); ?></td>
						</tr>
						<tr>
							<td class="txtinput">
								<select name="country_id" required="required">
									<?php foreach ($countries AS $country) { ?>
										<?php $selected = isset($_POST['country_id']) ? (($_POST['country_id'] == $country->country_id) ? 'selected="selected"' : '') : ($user['country_id'] == $country->country_id ? 'selected="selected"' : ((($user['country_id'] == '') && ($country->country_id == 8)) ? 'selected="selected"' : '' )); ?>
										<option value="<?php echo $country->country_id; ?>" <?php echo $selected; ?> ><?php echo $country->name; ?> </option>						
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="desc"><span class="required">*</span> <?php echo $this->lang->line('City'); ?> <?php echo $this->lang->line(':'); ?></td>
						</tr>
						<tr class="city_input <?php echo $user['country_id'] == 8 ? 'hide' : ''; ?>">
							<?php $city = isset($_POST['city']) ? $_POST['city'] : $user['city']; ?>
							<td class="txtinput"><input type="text" name="city" value="<?php echo $city; ?>" ></td>
						</tr>
                        <tr class="city_select <?php echo $user['country_id'] != 8 ? 'hide' : ''; ?>">
                            <td class="txtinput">
								<select name="city_id" required="required">
									<?php foreach ($cities AS $city) { ?>
										<?php $selected = isset($_POST['city_id']) ? (($_POST['city_id'] == $city->city_id) ? 'selected="selected"' : '') : ($user['city_id'] == $city->city_id ? 'selected="selected"' : ((($user['city_id'] == '0') && ($city->city_id == 1)) ? 'selected="selected"' : '' )); ?>
										<option value="<?php echo $city->city_id; ?>" <?php echo $selected; ?> ><?php echo $city->name; ?> </option>						
									<?php } ?>
								</select>
							</td>
                        </tr>
						<tr>
							<td class="desc"><span class="required">*</span> <?php echo $this->lang->line('Address');
							echo $this->lang->line(':');
							?></td>
						</tr>
						<tr>
                            <?php $address = isset($_POST['address']) ? $_POST['address'] : $user['address']; ?>
							<td class="txtinput"><input type="text" name="address" value="<?php echo $address; ?>"  required="required"></td>
						</tr>


						<tr>
							<td class="desc"><?php echo $this->lang->line('Additional:'); ?></td>
						</tr>
						<tr>
                            <?php $additional = isset($_POST['additional']) ? $_POST['additional'] : $user['additional']; ?>
							<td class="txtinput"><input type="text" name="additional" value="<?php echo $additional; ?>" ></td>
						</tr>
						<tr><td class="same_shipping">
                                <?php $same_shipping = isset($_POST['update_address']) ? (isset($_POST['same_shipping']) ? 1 : 0) : $user['same_shipping']; ?>
								<input id="same_shipping" type="checkbox" <?php echo $same_shipping == 1 ? 'checked="checked"' : ''; ?> name="same_shipping" /> 
								<label for="same_shipping"> <?php echo $this->lang->line('Shipping address is equal to main address'); ?></label>
							</td></tr>
					</tbody>
				</table>
				<table class="form shipping-table <?php echo $same_shipping == 1 ? 'hide' : ''; ?>">
					<tbody>
                        <tr>
							<td class="desc"> <?php echo $this->lang->line('Shipping First Name:'); ?> </td>
						</tr>
						<tr>
                            <?php $ship_first_name = isset($_POST['ship_first_name']) ? $_POST['ship_first_name'] : $user['ship_first_name']; ?>
							<td class="txtinput"><input type="text" name="ship_first_name" value="<?php echo $ship_first_name; ?>"></td>
						</tr>
						<tr>
							<td class="desc"> <?php echo $this->lang->line('Shipping Last Name:'); ?></td>
						</tr>
						<tr>
                            <?php $ship_last_name = isset($_POST['ship_last_name']) ? $_POST['ship_last_name'] : $user['ship_last_name']; ?>
							<td class="txtinput"><input type="text" name="ship_last_name" value="<?php echo $ship_last_name; ?>"></td>
						</tr>
						<tr>
							<td class="desc"> <?php echo $this->lang->line('Shipping Phone:'); ?></td>
						</tr>
						<tr>
                            <?php $ship_phone = isset($_POST['ship_phone']) ? $_POST['ship_phone'] : $user['ship_phone']; ?>
							<td class="txtinput"><input type="text" name="ship_phone" value="<?php echo $ship_phone; ?>" ></td>
						</tr>
                        
						<tr>
							<td class="desc"> <?php echo $this->lang->line('Shipping Country:'); ?></td>
						</tr>
						<tr>
							<td class="txtinput">
                                <select name="ship_country_id" disabled="disabled">
									<?php foreach ($countries AS $country) { ?>
										<?php $selected = ($country->country_id == 8) ? 'selected="selected"' : ''; ?>
										<option value="<?php echo $country->country_id; ?>" <?php echo $selected; ?> ><?php echo $country->name; ?> </option>						
                                    <?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td class="desc"> <?php echo $this->lang->line('Shipping City:'); ?></td>
						</tr>
						<tr class="<?php echo $user['ship_country_id'] == 8 ? 'hide' : ''; ?>">
                            <?php $ship_city = isset($_POST['ship_city']) ? $_POST['ship_city'] : $user['ship_city']; ?>
							<td class="txtinput"><input type="text" name="ship_city" value="<?php echo $ship_city; ?>"></td>
						</tr>
                        <tr class="<?php echo $user['ship_country_id'] != 8 ? 'hide' : ''; ?>">
                            <td class="txtinput">
								<select name="ship_city_id" required="required">
									<?php foreach ($cities AS $city) { ?>
										<?php $selected = isset($_POST['ship_city_id']) ? (($_POST['ship_city_id'] == $city->city_id) ? 'selected="selected"' : '') : ($user['ship_city_id'] == $city->city_id ? 'selected="selected"' : ((($user['ship_city_id'] == '0') && ($city->city_id == 1)) ? 'selected="selected"' : '' )); ?>
										<option value="<?php echo $city->city_id; ?>" <?php echo $selected; ?> ><?php echo $city->name; ?> </option>						
									<?php } ?>
								</select>
							</td>
                        </tr>
						<tr>
							<td class="desc"> <?php echo $this->lang->line('Shipping Address:'); ?></td>
						</tr>
						<tr>
                            <?php $ship_address = isset($_POST['ship_address']) ? $_POST['ship_address'] : $user['ship_address']; ?>
							<td class="txtinput"><input type="text" name="ship_address" value="<?php echo $ship_address; ?>"</td>
						</tr>
						
						
						

					</tbody>
				</table>
			</div>
			<div class="notification pass_note">
				<?php if (isset($update_error)) { ?>
					Something happend during updating, Please try again.
				<?php } ?>
				<?php if (isset($update_success)) { ?>
					<p class='success'><?php echo $this->lang->line('Address data updated successfully'); ?></p>
<?php } ?>
			</div>
			<div class="buttons">
				<div class="right smaller">
					<input type="submit" value="<?php echo $this->lang->line('Update'); ?>" name="update_address" class="button">
				</div>
			</div>
		</form>
    </div>
</div> 

<script>
	jQuery(document).ready(function() {

		$('input[name="same_shipping"]').click(function() {
			$(".shipping-table").toggle(400);
		});
        $('select[name=ship_country_id]').change(function(){
            $(this).val(8);
        });
        $('select[name=country_id]').change(function(){
            if($(this).val() == 8) {
                $('.city_input').hide();
                $('.city_select').show();
            } else {
                $('.city_input').show();
                $('.city_select').hide();
            }
        });
	});
</script>