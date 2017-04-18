<!--<pre><?php // var_dump($this->_ci_cached_vars);                      ?></pre>-->

<?php $step = 1;  ?>
<div id="content">
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?> » <a href="<?php echo site_url('shopping/cart'); ?>"><?php echo $this->lang->line('Shopping Cart'); ?></a> » <?php echo $this->lang->line('Checkout'); ?> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Checkout'); ?></span></h1>

    <?php if (isset($order_error)) { ?>
        <div class="error-order">
            <?php echo $order_error; ?>
        </div>
    <?php } ?>
    <form action="" method="post" id="checkout_form">
        <div class="checkout">
            <?php if (!isset($user_id)) { ?>
                <div id="checkout">
                    <div class="checkout-heading checkout<?php echo $step; ?>"><?php echo $this->lang->line('Step'); ?> <?php echo $step; ?>: <?php echo $this->lang->line('Checkout Options'); ?></div>
                    <div class="checkout-content checkout-content-login" <?php echo!isset($user_id) ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                        <div class="left">
                            <h2><?php echo $this->lang->line('New Customer'); ?></h2>

                            <label for="login-radio">
                                <input type="radio" name="account" value="login" id="login-radio" checked="checked">
                                <b><?php echo $this->lang->line('Registered Customer'); ?></b></label>
                            <br>
                            <label for="guest-radio">
                                <input type="radio" name="account" value="guest" id="guest-radio">
                                <b><?php echo $this->lang->line('Continue without registering'); ?></b></label>
                            <br>
                            <br>

                            <input type="button" value="<?php echo $this->lang->line('Continue'); ?>" id="button-account" class="button">
                            <br>
                            <br>
                            <br>
                        </div>
                        <div id="login" class="right">

                            <h2><?php echo $this->lang->line('Registered Customer'); ?></h2>

                            <b><?php echo $this->lang->line('Email:'); ?></b><br>
                            <input type="text" name="login_email" value="">
                            <br>
                            <br>
                            <b><?php echo $this->lang->line('Password:'); ?></b><br>
                            <input type="password" name="login_password" value="">
                            <br>
                            <a class="undreline" href="<?php echo site_url('account/forgotpassword'); ?>"><?php echo $this->lang->line('Forgot Password'); ?></a><br>
                            <br>
                            <input type="button" value="<?php echo $this->lang->line('Login'); ?>" id="button-login" class="button">
                            <br/>

                            <div class="login_result"></div>
                        </div>
                    </div>
                </div>
                <?php $step++; ?>
            <?php } ?>
            <?php //var_dump($user); ?>
            <div id="shipping-address">
                <div class="checkout-heading checkout<?php echo $step; ?>"><?php echo $this->lang->line('Step'); ?> <?php echo $step; ?>: <?php echo $this->lang->line('Account &amp; Billing Details'); ?></div>
                <div class="checkout-content checkout-content-register" <?php echo isset($user_id) ? 'style="display: block;"' : 'style="display: none;"'; ?>>
                    <div class="left">
                        <h2><?php echo $this->lang->line('Your Personal Details'); ?></h2>
                        <span class="required">*</span> <?php echo $this->lang->line('First Name:'); ?><br>
                        <input type="text" id="first_name" name="first_name" value="<?php echo isset($user) ? $user['first_name'] : ''; ?>" class="large-field"  required="required"/>
                        <div class="checkout_message text-warning"></div>
                        <br>
                        <br>
                        <?php echo $this->lang->line('Last Name:'); ?> <br>
                        <input type="text" id="last_name" name="last_name" value="<?php echo isset($user) ? $user['last_name'] : ''; ?>" class="large-field"/>
                        <div class="checkout_message text-warning"></div>
                        <br>
                        <br>
                        <span class="required">*</span> <?php echo $this->lang->line('Email:'); ?> <br>
                        <input type="text" id="email" name="email" value="<?php echo isset($user) ? $user['email'] : ''; ?>" class="large-field"  required="required"/>
                        <div class="checkout_message text-warning"></div>
                        <br>
                        <br>
                        <span class="required">*</span> <?php echo $this->lang->line('Phone');
            echo $this->lang->line(':'); ?><br>
                        <input type="text" id="phone" name="phone" value="<?php echo isset($user) ? $user['phone'] : ''; ?>" class="large-field"  required="required"/>
                        <div class="checkout_message text-warning"></div>
                        <br>
                        <br>
                        <div style="clear: both;">
                            <input type="checkbox" name="same_shipping" value="1" id="shipping" <?php echo!isset($user) ? 'checked="checked"' : ( $user['same_shipping'] == 1 ? 'checked="checked"' : ''); ?>>
                            <label for="shipping"><?php echo $this->lang->line('My delivery and billing addresses are the same'); ?></label>
                        </div>

<?php if (!isset($user)) { ?>
                            <?php // @todo I have made next div hidden, as that wasn't working properly. That need to be fixed. ?>
                            <div style="clear: both; " class="hidden">

                                <input type="checkbox" name="register-account" value="1" id="register-account">
                                <label for="register-account"><?php echo $this->lang->line('If you would like to register'); ?></label>
                                <br>
                            </div>
                            <div class="checkout-password-wrapper hide">
                                <h2><?php echo $this->lang->line('Your Password'); ?></h2>
                                <span class="required">*</span> <?php echo $this->lang->line('Password:'); ?><br>
                                <input type="password" name="password" value="" class="large-field">
                                <div class="checkout_message text-warning"></div>
                                <br>
                                <br>
                                <span class="required">*</span> <?php echo $this->lang->line('Password Confirm:'); ?><br>
                                <input type="password" name="repeat_password" value="" class="large-field">
                                <br>
                                <br>
                                <div class="pass_note"></div>
                            </div>
                        <?php } else { ?>

<?php } ?>
                    </div>
                    <div class="right">
                        <h2><?php echo $this->lang->line('Shipping Address'); ?></h2>
                        <div class="shipping-details" />
                        <span class="required">*</span> <?php echo $this->lang->line('Shipping First Name:'); ?><br/>
<?php $ship_first_name = isset($_POST['ship_first_name']) ? $_POST['ship_first_name'] : (isset($user_id) ? ($user['same_shipping'] == 1 ? $user['first_name'] : $user['ship_first_name']) : '') ?>
                        <input type="text" id="ship_first_name" name="ship_first_name" value="<?php echo $ship_first_name; ?>" class="large-field"  required="required"/>
                        <div class="checkout_message text-warning"></div>
                        <br>
                        <br>
                        <?php echo $this->lang->line('Shipping Last Name:'); ?><br/>
<?php $ship_last_name = isset($_POST['ship_last_name']) ? $_POST['ship_last_name'] : (isset($user_id) ? ($user['same_shipping'] == 1 ? $user['last_name'] : $user['ship_last_name']) : '') ?>
                        <input type="text" id="ship_last_name" name="ship_last_name" value="<?php echo $ship_last_name; ?>" class="large-field"/>
                        <div class="checkout_message text-warning"></div>
                        <br>
                        <br>
                        <span class="required">*</span> <?php echo $this->lang->line('Shipping Phone:'); ?><br/>
<?php $ship_phone = isset($_POST['ship_phone']) ? $_POST['ship_phone'] : (isset($user_id) ? ($user['same_shipping'] == 1 ? $user['phone'] : $user['ship_phone']) : '') ?>
                        <input type="text" id="ship_phone" name="ship_phone" value="<?php echo $ship_phone; ?>" class="large-field"  required="required"/>
                        <div class="checkout_message text-warning"></div>
                        <br>
                        <br>
                    </div>
                    <span class="required">*</span> <?php echo $this->lang->line('Country'); ?><?php echo $this->lang->line(':'); ?><br/>
                    <select name="ship_country_id" required="required" disabled="disabled">
                        <option value="0"> --- Please Select --- </option>
                        <?php foreach ($countries AS $country) { ?>
                            <?php $selected = ($country->country_id == 8) ? 'selected="selected"' : ''; ?>
                            <option value="<?php echo $country->country_id; ?>" <?php echo $selected; ?> ><?php echo $country->name; ?> </option>
<?php } ?>
                    </select>
                    <br>
                    <br>
                    <span class="required">*</span> <?php echo $this->lang->line('City'); ?><?php echo $this->lang->line(':'); ?><br/>
                    <select name="ship_city_id" required="required">
                        <?php foreach ($cities AS $city) { ?>
                            <?php $selected = isset($_POST['ship_city_id']) ? (($_POST['ship_city_id'] == $city->city_id) ? 'selected="selected"' : '') : (isset($user) && $user['ship_city_id'] == $city->city_id ? 'selected="selected"' : (((!isset($user)) && ($city->city_id == 1)) ? 'selected="selected"' : '' )); ?>
                            <option value="<?php echo $city->city_id; ?>" <?php echo $selected; ?> ><?php echo $city->name; ?> </option>
<?php } ?>
                    </select>
                    <br>
                    <br>
                    <span class="required">*</span> <?php echo $this->lang->line('Address'); ?><?php echo $this->lang->line(':'); ?><br/>
<?php $ship_address = isset($_POST['ship_address']) ? $_POST['ship_address'] : (isset($user_id) ? ($user['same_shipping'] == 1 ? $user['address'] : $user['ship_address']) : '') ?>
                    <input type="text" id="ship_address" name="ship_address" value="<?php echo $ship_address; ?>" class="large-field" required="required"/>
                    <div class="checkout_message text-warning"></div>
                    <br>
                    <br>


                    <div class="buttons">
                        <?php if (isset($user_id)) { ?>
                            <?php //echo $this->lang->line('Save data to my account'); ?>
                            <input type="button" name="save_data"  title="Setting this checkbox will mean that after ordering your account details will take these changes" value="<?php echo $this->lang->line('Save data to my account'); ?>" />
<?php } ?>
                        <input type="button" value="<?php echo $this->lang->line('Continue'); ?>" name="save_my_data" id="button-register" class="button">
                    </div>
                    <div style="color: #3FAE2A;" class="hidden save_user_success"><?php echo $this->lang->line('Save user data successful'); ?></div>
                </div>
            </div>
        </div>
<?php $step++; ?>
        <div id="payment-method">
            <div class="checkout-heading checkout<?php echo $step; ?>"><?php echo $this->lang->line('Step'); ?> <?php echo $step; ?>: <?php echo $this->lang->line('Payment method and additional information'); ?></div>
            <div class="checkout-content  checkout-content-payment-method" style="display: none; ">
                <p><?php echo $this->lang->line('Payment method:'); ?></p>
                <table class="radio">
                    <tbody>
                        <tr class="highlight">
                            <td><input type="radio" name="payment_method" value="cod" id="cod" checked="checked"></td>
                            <td><label for="cod"><?php echo $this->lang->line('Cash On Delivery'); ?></label></td>
                        </tr>
                        <tr class="highlight">
                            <td><input type="checkbox" name="checkbox_points" value="" id="checkbox_points" <?php echo $this->session->userdata('user_id') ? '' : 'disabled="disabled"'; ?> ></td>
                            <td><label for="checkbox_points">
                                    <div id="inline-popups">
                                        <?php if (!$this->session->userdata('user_id')){ ?>
                                        <a href="#point-popup" data-effect="mfp-zoom-in">
                                            <?php echo $this->lang->line('Pay off the accumulated points'); ?>
                                        </a>
                                        <?php }else{
                                            echo $this->lang->line('Pay off the accumulated points');
                                        } ?>



                                    </div>

                                </label></td>
                        </tr>
                    </tbody>
                </table>

                    <div id="point-popup" class="white-popup mfp-with-anim mfp-hide">
                    <h3><?php echo $this->lang->line('By registering you can'); ?></h3>
                        <br/>
                    <ul >
                         <li> <a href="<?php echo site_url('page/points'); ?>"><?php echo $this->lang->line('Why register text5'); ?><br/><br/><?php echo $this->lang->line('know more'); ?> </a></li>
                    </ul>
                </div>
                <input type="text" name="order_points" class="points large-field hidden" value="" />
                <br>
                <b><?php echo $this->lang->line('Add Comments About Your Order'); ?></b>
                <textarea name="comment" rows="8" style="width: 98%;"></textarea>
                <br>
                <br>
                <div class="buttons">
                    <div class="right">
                        <input type="button" value="<?php echo $this->lang->line('Continue'); ?>" id="button-payment-method" class="button">
                    </div>
                </div>
            </div>
        </div>
<?php $step++; ?>
        <div id="confirm">
            <div class="checkout-heading checkout<?php echo $step; ?>"><?php echo $this->lang->line('Step'); ?> <?php echo $step; ?>: <?php echo $this->lang->line('Confirm Order'); ?></div>
            <div class="checkout-content  checkout-content-confirm" style="display: none; ">

                <div class="checkout-product">
                    <table>
                        <thead>
                            <tr>
                                <td></td>
                                <td class="name"><?php echo $this->lang->line('Product Name'); ?></td>
                                <td class="model"><?php echo $this->lang->line('Code'); ?></td>
                                <td class="quantity"><?php echo $this->lang->line('Quantity'); ?></td>
                                <td class="price"><?php echo $this->lang->line('Price'); ?></td>
                                <td class="total"><?php echo $this->lang->line('Total'); ?></td>
                            </tr>
                        </thead>
                        <tbody class="checkout-product-body">
                            <?php
                            $cart['total'] = 0;
                            $cart['quantity'] = 0;
                            $i = 1;
//                            echo '<pre>'; var_dump($cart);
//                            echo '<pre>'; var_dump($shopping_cart);

                            foreach ($shopping_cart AS $product) {
                                $subtotal = intval($product->quantity * $product->total_amount/$product->quantity);
                                $cart['total'] += $subtotal;
                                $cart['quantity'] += intval($product->quantity);
                                $product_url = product_url($product->id, $product->name);
                                ?>
                                <tr>
                                    <td class="list-order"><?php echo $i++; ?>.</td>
                                    <td class="name"><a href="<?php echo $product_url ?>"><?php echo $product->name; ?></a></td>
                                    <td class="model"><?php echo $product->code; ?></td>
                                    <td class="quantity"><?php echo $product->quantity; ?></td>
                                    <td class="price"><?php echo (int)$product->total_amount/(int)$product->quantity . ' ' . $this->lang->line('AMD'); ?></td>
                                    <td class="total"><?php echo $subtotal . ' ' . $this->lang->line('AMD'); ?></td>
                                </tr>
                        <?php } ?>
                        </tbody>
<?php $cart['delivery'] = $delivery_price > 0 ? $delivery_price : ($cart['total'] >= $static_delivery_price ? 0 : $min_delivery_price); ?>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="price"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                                <td class="total shopping-checkout-subtotal"><?php echo $cart['total'] . ' ' . $this->lang->line('AMD'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="price"><b><?php echo $this->lang->line('Delivery:'); ?></b></td>
                                <td class="total shopping-checkout-delivery"><?php echo $cart['delivery'] . ' ' . $this->lang->line('AMD'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="price"><b><?php echo $this->lang->line('Points:'); ?></b></td>
                                <td class="total shopping-checkout-points"><span>0</span><?php echo ' '.$this->lang->line('AMD'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="price"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                                <td class="total shopping-checkout-total"><?php echo '<span>'. ($cart['total'] + $cart['delivery']) .'</span> ' . $this->lang->line('AMD'); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="payment">
                    <div class="buttons">
                        <div class="right">

                                <!--I have read and agree to the <a class="colorbox cboxElement" href="<?php echo base_url('terms.php'); ?>" alt="Terms &amp; Conditionstermsandconditions"><b>Terms &amp; Conditions</b></a>
                                <input type="checkbox" name="term_agree" value="1"><br/>-->
                            <span class="empty-field-note"></span>
                            <input type="submit" value="<?php echo $this->lang->line('Confirm Order'); ?>" name="submit_order" id="button-confirm" class="button"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</form>
</div>


<script>
    window.delivery_price = <?php echo isset($delivery_price) ? $delivery_price : 0; ?>;
    window.delivery_city_id = <?php echo isset($delivery_city_id) ? $delivery_city_id : 1; ?>;
    window.min_delivery_price = <?php echo isset($min_delivery_price) ? $min_delivery_price : 1000; ?>;
    window.min_delivery_price = <?php echo isset($static_delivery_price) ? $static_delivery_price : 15000; ?>;
    window.city_price = [];

<?php if (isset($city_price) && is_array($city_price)) { ?>
    <?php foreach ($city_price AS $id => $city) { ?>
        city_price[<?php echo  $id; ?>] = '<?php echo $city['price']; ?>';
    <?php } ?>
<?php } ?>

    jQuery(document).ready(function($) {

        ship_data = [];
        user_data = [];
        ship_data = {
            'ship_first_name': '<?php echo isset($user) ? $user['ship_first_name'] : ''; ?>',
            'ship_last_name': '<?php echo isset($user) ? $user['ship_last_name'] : ''; ?>',
            'ship_phone': '<?php echo isset($user) ? $user['ship_phone'] : ''; ?>'
        };
        user_data = {
            'ship_first_name': '<?php echo isset($user) ? $user['first_name'] : ''; ?>',
            'ship_last_name': '<?php echo isset($user) ? $user['last_name'] : ''; ?>',
            'ship_phone': '<?php echo isset($user) ? $user['phone'] : ''; ?>'
        };

        user_total_points = '<?php echo $this->session->userdata('total_points'); ?>';

        $('input[name=same_shipping]').change(function() {
            if ($(this).is(':checked')) {
                for (var name in user_data) {
                    $('input[name=' + name + ']').val(user_data[name]);
                }
            } else {
                for (var name in ship_data) {
                    $('input[name=' + name + ']').val(ship_data[name]);
                }
            }
        });
        $('.checkout-content-register input[type=text]').keyup(function() {
            var name = $(this).attr('name');
            var is_ship_data = name.indexOf("ship_") > -1;
            var is_same_shipping = $('input[name=same_shipping]').is(':checked');
            if (is_ship_data) {
                ship_data[name] = $(this).val();
            } else {
                var ship_name = 'ship_' + name;
                user_data[ship_name] = $(this).val();
                if (is_same_shipping) {
                    ship_data[ship_name] = $(this).val();
                    $('input[name=' + ship_name + ']').val(ship_data[ship_name]);
                }
            }
        });

        $('#checkbox_points').change(function() {
            var total_cart = '<?php echo $cart['total'] + $cart['delivery']; ?>';
            if($(this).is(":checked")) {
                if(parseInt(user_total_points) < parseInt(total_cart)){
                    $('input[name="order_points"]').val(user_total_points);
                    $('input[name="checkbox_points"]').val(user_total_points);
                }else{
                    $('input[name="order_points"]').val(0);
                    $('input[name="checkbox_points"]').val(0);
                }
                $('.shopping-checkout-points span').text($('input[name="order_points"]').val());
                $('input[name="order_points"]').removeClass('hidden');
            }else{
                $('input[name="order_points"]').addClass('hidden');
                $('input[name="order_points"]').val('');
                $('.shopping-checkout-points span').text(0);
            }

        });
        $('#confirm, #button-payment-method').click(function(){
            var total = parseInt('<?php echo  ($cart['total'] + $cart['delivery']); ?>');
            var points = parseInt($('.shopping-checkout-points span').text());
            $('.shopping-checkout-total span').text(total - points);
        });

        $('input[name="order_points"]').keyup(function(){
            var intRegex = /[0-9]+$/;
            var patt = new RegExp(intRegex);
            if((parseInt($(this).val()) > parseInt(user_total_points) || !patt.test($(this).val())) && $(this).val() != ''){
                $(this).val(user_total_points);
                $('input[name="checkbox_points"]').val(user_total_points);
            }else{
                var val = $(this).val() != '' ? $(this).val() : 0;
                $('input[name="checkbox_points"]').val(val);
                $('.shopping-checkout-points span').text(val);
            }
        });


        $('.checkout-content-register input[name=password], .checkout-content-register input[name=repeat_password]').keyup(function() {
            var pass = $('.checkout-content-register input[name=password]').val();
            var rep_pass = $('.checkout-content-register input[name=repeat_password]').val();
            var $_note = $('.checkout-content-register .pass_note');
            if (pass != '') {
                if (pass.length > 5) {
                    if (pass == rep_pass) {
                        $_note.text('Passwords are setted in right way.');
                    } else {
                        $_note.text('<?php echo $this->lang->line("Passwords are not match"); ?>');
                    }
                } else {
                    $_note.text('<?php echo $this->lang->line("Password must contain at least 6 characters"); ?>');
                }

            }
        });


        $('input[name=register-account]').change(function() {
            if ($(this).is(':checked')) {
                $('.checkout-password-wrapper').show();
            } else {
                $('.checkout-password-wrapper').hide();
            }
        });
        $('#button-account').click(function() {
            $('.checkout-content-register').slideDown();
            $('.checkout-content-login').slideUp();
        });
        $('#button-register').click(function() {

            var checkout_form_data = $("#checkout_form").serializeArray();

            $.ajax({
                url: base_url +  language + "/ajax/checkoutValidateInfo",
                dataType: 'json',
                type: 'post',
                data: checkout_form_data,
                success: function(data) {
                    $.each(data, function(index,value){
                        //process your data by index, in example
                        if(index == "success" && value == 1){
                            $('.checkout-content-payment-method').slideDown();
                            $('.checkout-content-register').slideUp();
                        }else{
                            var increment = 1;
                            if(value.length == 1){
                                $("#"+index).next().empty();
                                $("#"+index).removeClass("form_val_input");
                            }else{
                                $.each(value, function(index2,value2){
                                    if(index !== "reg_error"){
                                        if(increment == 1){
                                            $("#"+index).next().empty();
                                        }
                                        $("#"+index).addClass("form_val_input");
                                        $("#"+index).next().append(value2);
                                    }
                                    increment++;
                                });
                            }
                        }
                    });
                }
            });
            return false;
        });
        $('#button-payment-method').click(function() {
            $('.checkout-content-confirm').slideDown();
            $('.checkout-content-payment-method').slideUp();
        });

        $('input[name="save_data"]').click(function() {
            var save_input = '<input type="hidden" name="save_my_data" value="true" class="hidden_save_data" />';
            $("#checkout_form").append(save_input);
            var checkout_form_data = $("#checkout_form").serializeArray();

            $.ajax({
                url: base_url +  language + "/ajax/checkoutValidateInfo",
                dataType: 'json',
                type: 'post',
                data: checkout_form_data,
                success: function(data) {
                    $('.hidden_save_data').remove();
                    $.each(data, function(index,value){
                        //process your data by index, in example
                        if(index == "success" && value == 1){
                            $('.save_user_success').show(0).delay(4000).hide(0);
                        }else{
                            var increment = 1;
                            if(value.length == 1){
                                $("#"+index).next().empty();
                                $("#"+index).removeClass("form_val_input");
                            }else{
                                $.each(value, function(index2,value2){
                                    if(index !== "reg_error"){
                                        if(increment == 1){
                                            $("#"+index).next().empty();
                                        }
                                        $("#"+index).addClass("form_val_input");
                                        $("#"+index).next().append(value2);
                                    }
                                    increment++;
                                });
                            }
                        }
                    });
                }
            });
        });
        $("#login input[name=login_email]").keydown(function(event) {
            if (event.which == 13) {
                //event.preventDefault();
                $('#button-login').click();
            }
        });
        $("#login input[name=login_password]").keydown(function(event) {
            if (event.which == 13) {
                //event.preventDefault();
                $('#button-login').click();
            }
        });
        $('#button-login').click(function() {
            var email = $("#login input[name=login_email]").val();
            var password = $("#login input[name=login_password]").val();
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {
                    action: 'login',
                    email: email,
                    password: password
                },
                success: function(data) {
                    if (data.success) {
                        location.reload();
                    } else {
                        $("#login .login_result").text('<?php echo $this->lang->line("Invalid details"); ?>');
                        setTimeout(function() {
                            $("#login .login_result").fadeOut(1500, function() {
                                $(this).empty().show();
                            });
                        }, 1000);
                    }
                }
            });
            return false;
        });

        $('select[name=ship_country_id]').change(function() {
            $(this).val(8);
        });

        $('#button-confirm').click(function() {
            var empty = false;
            $('.checkout-content-register input[type=text]').each(function(i, input) {
                if ($(this).prop('required') && $.trim($(this).val()) == '') {
                    empty = true;
                    console.log(input);
                }
            });
            if (empty) {
//                    $('.checkout-content-register').slideDown();
//                    $('.checkout-content-confirm').slideUp();
                $('.empty-field-note').text('<?php echo $this->lang->line("Please fill all required fields"); ?>');
                setTimeout(function() {
                    $(".empty-field-note").fadeOut(1500, function() {
                        $(this).empty().show();
                    });
                }, 2000);
            }
            if (empty) {
                return false;
            }
        });
        /*
         $('input[name=term_agree]').change(function() {
         if ($(this).is(':checked')) {
         $('input[name=submit_order]').removeAttr("disabled");
         } else {
         $('input[name=submit_order]').attr("disabled", 'disabled');
         }
         
         });
         */
        $('.checkout-content-login input[name=account]').change(function() {
            if ($(this).val() == 'login') {
                $('.checkout-content-login #login').show();
            } else {
                $('.checkout-content-login #login').hide();
				$('#button-account').click();
            }
        });

        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }
    });
</script>