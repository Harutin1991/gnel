jQuery(document).ready(function() {
    $("a[href='']").click(function() {
        return false;
    });
    $("#column-left .box-category li a").click(function() {
        if ($(this).siblings('ul').size() > 0) {
            var a = $(this);
            if (a.hasClass("active")) {
                a.removeClass("active");
            } else {
                a.addClass("active");
            }
            return false;
        }
    });
    $(document).on('keyup', 'input[name=product-quantity]', function(event) {

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode === 13) {
            $(this).blur();
        }

    });
    $(document).on('blur', 'input[name=product-quantity]', function() {
        var $_this = $(this);
        var prod_id = $_this.attr('prod-id');

        var action = 'update_shopping_cart';
        var prod_qty = parseInt($_this.val());
        console.log(prod_qty);
        prod_qty = (prod_qty !== NaN && prod_qty > 0) ? prod_qty : 1;
        $_this.val(prod_qty);
        addToCart(prod_id, prod_qty, $_this, action);

        return false;
    });
    $(document).on('click', 'input[name=add-to-cart]', function() {
        var $_this = $(this);
        var prod_id = $_this.attr('prod-id');

        var action = 'add_to_cart';
        var prod_qty = $('input[name=prod-qty]').val();
        prod_qty = typeof prod_qty != 'undefined' ? prod_qty : 1;
        addToCart(prod_id, prod_qty, $_this, action);

        return false;
    });
    $(document).on('click', '.mini-cart-info .remove img, .remove-product-from-cart', function() {
        var $_this = $(this);
        var prod_id = $_this.attr('product-id');
        console.log(prod_id);
        var temp_id = $.cookie('temp_id');
        $.ajax({
            url: base_url + "ajax",
            dataType: 'json',
            type: 'post',
            data: {
                action: 'remove_form_cart',
                temp_id: temp_id,
                prod_id: prod_id
            },
            success: function(data) {
                if (data.success) {
                    drawSmallShoppingCart(data.products);
                    if ($('.cart-info-body').length && jQuery()) {
                        drawShoppingCart(data.products);
                    }
                    if ($('.checkout-product-body').length && jQuery()) {
                        drawCheckoutProduct(data.products);
                    }
                } else {
                    console.log(data);
                }
            }
        });
        return false;
    });

    $('select[name=ship_city_id]').change(function() {
        delivery_city_id = $(this).val();
        var total = $('.shopping-checkout-subtotal').text();
        total = total.split(' ');
        total = parseInt(total[0]);
        var delivery = parseInt(delivery_city_id != 1 ? city_price[delivery_city_id] : (total >= static_delivery_price ? 0 : min_delivery_price));
        $('.shopping-checkout-delivery').html(delivery + ' ' + currency);

        $('.shopping-checkout-total').html((total + delivery) + ' ' + currency);
    });

    $("#rc-phone-input").keyup(function() {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode === 13) {
            $('#order_call_button').click();
        }
    });
    var curr_num = '';
    $('#order_call_button').click(function() {
        var new_num = $('#rc-phone-input').val();
        var reg = new RegExp('^\[0-9+()]+$');

        if (curr_num !== new_num && reg.test(new_num) && new_num.length >= 6) {
            curr_num = new_num;
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {
                    action: 'order_call',
                    phone: new_num
                },
                success: function(data) {
                    if (data.success) {
                        $('.before_call_submit').hide(600, function() {
                            $(".after_call_submit").show(600);
							$("#rc-phone-input").prop('disabled', true);
                        });
                    } else {
                        console.log(data);
                    }
                }
            });
            return false;

        }
    });

    function addToCart(prod_id, prod_qty, $_this, action) {
        var temp_id = $.cookie('temp_id');
        if (temp_id != undefined) {
            // var name = $_this.attr('name');
            var $_similar_inp = $("td input[prod-id="+ prod_id +"]");

            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                    $_similar_inp.prop('disabled', true);
                    var parent_tr = $_similar_inp.closest('tr');
                    $_similar_inp.after('<img class="similar_inp_load" src="/images/icons/ajax-loader.gif">');
                },
                data: {
                    action: action,
                    temp_id: temp_id,
                    prod_qty: prod_qty,
                    prod_id: prod_id
                },
                success: function(data) {
                    moveProductImageToBasket(prod_id);
                    setTimeout(function() {
                        if (data.success) {
                            drawSmallShoppingCart(data.products);
                            if ($('.cart-info-body').length && jQuery()) {
                                drawShoppingCart(data.products, prod_id);
                            }
                        } else {
                            console.log(data);
                        }

                        $_similar_inp.prop('disabled', false);
                        $(".similar_inp_load").remove();
                    }, 1200);
                }
            });
        }
    }

    function moveProductImageToBasket(prod_id) {
        var this_nkar = $('.image-product-' + prod_id + ' img');
        if (this_nkar.length > 0) {
            var clon_offset_left = this_nkar.offset().left;
            var clon_offset_top = this_nkar.offset().top;
            var clon = this_nkar.clone();
            var basket_left = $(".shopping-basket").offset().left;
            var basket_top = $(".shopping-basket").offset().top;
            clon.css({
                'position': 'absolute',
                'border-radius': '15px',
                'z-index': 10000,
                'width': this_nkar.width() - 30,
                'left': clon_offset_left,
                'top': clon_offset_top
            });
            $('body').append(clon);

            clon.animate({
                'left': basket_left,
                'height': '0px',
                'width': '0px',
                'top': basket_top,
                'opacity': '0.1'
            }, 1200, function() {
                clon.remove();
            });
        }
    }

    function drawSmallShoppingCart(product) {
        var html = '<table><tbodey>';
        var total = 0;
        var quantity = 0;
        var product_url, subtotal, image_url;
        for (var i in product) {
            subtotal = parseInt(product[i].total_amount);
            total += subtotal;
            quantity += parseInt(product[i].quantity);
            product_url = site_url + 'product/' + product[i].name + '-p' + product[i].id + '.html';
            image_url = base_url + 'images/product/' + product[i].id + '/' + product[i].image;
            html += '<tr>';
            html += '<td class="image">';
                // var sale_for_table = '';
                // if(product[i].percent_off != 0){
                //     sale_for_table = product[i].percent_off + " %";
                // }
                // if(product[i].amount_off != 0){
                //  sale_for_table = "Sale";
                // }
                // if(sale_for_table != ''){
                //     html += '<span class="sale_for_table">'+sale_for_table+'</span>';
                // }
            html += '<a href="' + product_url + '"><img src="' + image_url + '" alt="' + product[i].name + '" title="' + product[i].name + '"></a>';
            html += '</td>';

            html += '<td class="name"><a href="' + product_url + '"><span class="mini-cart-product-name">' + product[i].name + '</span></a>';
            html += '<div> </div></td>';
            html += '<td class="quantity">x&nbsp;' + product[i].quantity + '</td>';
            html += '<td class="total">' + subtotal + ' ' + currency + '</td>';
            html += '<td class="remove"><img src="' + base_url + 'images/icons/remove-small.png" alt="" title="" product-id="' + product[i].id + '"></td>';
            html += '</tr>';
        }

        html += '</tbodey></table>';
        $('.mini-cart-info').html(html);
        $('.cart-total-count').html(quantity);
        $('.cart-total-amount').html(total);

        //check if checkout page and order total is 0, redirect to cart page
        var url = window.location.href;
        if (total == 0 && url.indexOf('shopping/checkout') > -1) {
            window.location.href = site_url + 'shopping/cart';
        }
    }

    // function drawShoppingCart(product, prod_id) {
    //     var html = '';
    //     var total = 0;
    //     var quantity = 0;
    //     var product_url, subtotal, image_url;
    //     for (var i in product) {
    //         console.log(product[i].id,prod_id);
    //         subtotal = parseInt(product[i].total_amount);
    //         total += subtotal;
    //         quantity += parseInt(product[i].quantity);
    //         if(prod_id == product[i].id) {
    //             $("td.total[prod-id="+ prod_id +"]").text(product[i].total_amount + ' ' + currency);
    //         }
    //     }
    //
    //     var delivery = delivery_city_id != 1 ? city_price[delivery_city_id] : (total >= static_delivery_price ? 0 : min_delivery_price);
    //
    //     $('.shopping-cart-delivery').html(delivery + ' ' + currency);
    //     $('.shopping-cart-subtotal').html(total + ' ' + currency);
    //     $('.shopping-cart-total').html((total + delivery) + ' ' + currency);
    // }

    function drawShoppingCart(product) {
        var html = '';
        var total = 0;
        var quantity = 0;
        var product_url, subtotal, image_url;
        for (var i in product) {
            console.log(product[i].quantity);
            console.log(product[i].total_amount);
            subtotal = parseInt(product[i].total_amount);
            total += subtotal;
            quantity += parseInt(product[i].quantity);
            product_url = site_url + 'product/' + product[i].name + '-p' + product[i].id + '.html';
            image_url = base_url + 'images/product/' + product[i].id + '/' + product[i].image;
            html += '<tr>';
            html += '<td colspan="6" class="emptyrow"></td>';
            html += '</tr>';
            html += '<tr>';

            html += '<td class="image">';
            var sale_for_table = '';
            if(product[i].percent_off != 0){
                sale_for_table = product[i].percent_off + " %";
            }
            if(product[i].amount_off != 0){
                sale_for_table = sale;
            }
            if(sale_for_table != ''){
                html += '<span class="sale_for_table">'+sale_for_table+'</span>';
            }
            html += '<a href="' + product_url + '"><img src="' + image_url + '" alt="' + product[i].name + '" title="' + product[i].name + '"></a>';
            html += '</td>';


            html += '<td class="name"><a href="' + product_url + '">' + product[i].name + '</a>';
            html += '<div> </div></td>';
            html += '<td class="model">' + product[i].code + '</td>';
            html += '<td class="quantity"><input type="text" name="product-quantity" value="' + product[i].quantity + '" size="1" prod-id="' + product[i].id + '"></td>';
            html += '<td class="price">' + product[i].total_amount/product[i].quantity + ' ' + currency + '</td>';
            html += '<td class="total">' + subtotal + ' ' + currency + '<br/';
            html += '<div class="reload">';
            html += '</div></td>';
            html += '<td class="product-acition"><span class="icon icon-nomargin icon-floatright"><i class="fa fa-times fa-fw remove-product-from-cart" product-id="' + product[i].id + '"></i></span></td>';

            html += '</tr>';
            html += '<tr>';
            html += '<td colspan="6" class="emptyrow"></td>';
            html += '</tr>';
        }

        var delivery = delivery_city_id != 1 ? city_price[delivery_city_id] : (total >= static_delivery_price ? 0 : min_delivery_price);
        $('.cart-info-body').html(html);
        $('.shopping-cart-delivery').html(delivery + ' ' + currency);
        $('.shopping-cart-subtotal').html(total + ' ' + currency);
        $('.shopping-cart-total').html((total + delivery) + ' ' + currency);
    }

    function drawCheckoutProduct(product) {
        var html = '';
        var total = 0;
        var quantity = 0;
        var n = 1;
        var product_url, subtotal, image_url;
        for (var i in product) {
            subtotal = parseInt(product[i].total_amount);
            total += subtotal;
            quantity += parseInt(product[i].quantity);
            product_url = site_url + 'product/' + product[i].name + '-p' + product[i].id + '.html';
            image_url = base_url + 'images/product/' + product[i].id + '/' + product[i].image.addClasses();
            html += '<tr>';
            html += '<td class="list-order">' + n++ + '.</td>';
            html += '<td class="name"><a href="' + product_url + '">' + product[i].name + '</a></td>';
            html += '<td class="model">' + product[i].code + '</td>';
            html += '<td class="quantity">' + product[i].quantity + '</td>';
            html += '<td class="price">' + product[i].price + ' ' + currency + '</td>';
            html += '<td class="total">' + subtotal + ' ' + currency + '</td>';
            html += '</tr>';
        }

        var delivery = delivery_city_id != 1 ? city_price[delivery_city_id] : (total >= static_delivery_price ? 0 : min_delivery_price);

        $('.checkout-product-body').html(html);
        $('.shopping-checkout-delivery').html(delivery + ' ' + currency);
        $('.shopping-checkout-subtotal').html(total + ' ' + currency);
        $('.shopping-checkout-total').html((total + delivery) + ' ' + currency);
    }

    $("input[name=search]").keyup(function(event) {
        $('.search-link').attr('href', site_url + 'product/search/' + $(this).val());
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode === 13) {
            window.location.href = $('.search-link').attr('href');
        }
    });

    var current_rate = $('.rating_radio input[name=rating]:checked').val();
    $('#button-vote').click(function() {
        var rate = $('.rating_radio input[name=rating]:checked').val();
        if (typeof rate !== 'undefined') {


            var product_id = $('input[name=product_id]').val();
            if (current_rate != rate) {
                $.ajax({
                    url: base_url + "ajax",
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function() {
                    },
                    data: {
                        action: 'rate_product',
                        product_id: product_id,
                        rate: rate
                    },
                    success: function(data) {
                        if (data.success) {
                            console.log(data.total_points);
                            if(data.total_points != '0') {
                                $('.user_points span').text(data.total_points);
                            }
                            $('.rate_text .avg_rate').text(data.avg_rate);
                            $('.rate_text .voters_count').text(data.voters_count);
                            $('.rate_stars img').attr('src', base_url + 'images/icons/stars/stars-' + Math.round(data.avg_rate) + '.png');
                            $('img[commented_user=me]').attr('src', base_url + 'images/icons/stars/stars-' + rate + '.png');
                            current_rate = $('.rating_radio input[name=rating]:checked').val();
                            $('.rating_radio').toggle("slow");
                        }
                    }
                });
            } else {
                $('.rating_radio').toggle("slow");
            }
        }
    });
//    $('#button-review').click(function() {
//        var commentator_name = $('input[name=commentator_name]').val();
//        commentator_name = commentator_name.trim();
//        var comment = $('textarea[name=comment]').val();
//        comment = comment.trim();
//        if (commentator_name != '' && comment != '') {
//            var product_id = $('input[name=product_id]').val();
//            $.ajax({
//                url: base_url + "ajax",
//                dataType: 'json',
//                type: 'post',
//                beforeSend: function() {
//                },
//                data: {
//                    action: 'comment_product',
//                    product_id: product_id,
//                    commentator_name: commentator_name,
//                    comment: comment
//                },
//                success: function(data) {
//                    if (data.success) {
//                        //$('.review-form-wrapper').hide();
//                        $('textarea[name=comment]').val('');
//                        var html = '<div class="review-list">';
//                        html += '<div class="author"><b>ssievert</b>  on  12/02/2013</div>';
//                        html += '<div class="rating"><img src="<?php echo base_url('images/icons/stars/stars-4.png'); ?>" alt="1 reviews"></div>';
//                        html += '<div class="text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</div>';
//            </div>';
//                        $('#review .pagination').before(html);
//
//                    }
//                }
//            });
//        } else {
//            $('.notify-empty').show();
//            setTimeout(function() {
//                $(".notify-empty").fadeOut(1500);
//            }, 1000);
//
//        }
//
//    });
    $('#view_comment_link a').click(function() {
        $('a[href=#tab-review]').click();

//         $('html,body').animate({
//            scrollTop: $('a[href=#tab-review]').offset().top + 'px'},
//        'slow');
//        return false;
    });


// phone call hover
/*
    var is_hovered = false;
    $(".phone_icon_singl").hover(function() {
        var $_this = $(this);
        is_hovered = true;
        setTimeout(function(){
            if(is_hovered){
                if($_this.css('display') !== 'none') {
                    $_this.hide();
                    $("#call_connect").css({"width": "50px"}).show().animate({"width": "375px"}, 500);
                }
            }
        }, 1000);
        
    }, function(){
        is_hovered = false;
    });
*/

// phone call click
    $(".phone_icon_singl").click(function() {
        var $_this = $(this);
        is_hovered = true;
		$_this.hide();
		$("#call_connect").css({"width": "50px"}).show().animate({"width": "375px"}, 500);
    });

	
	
	

    $("#call_connect").hover(function() {
        $("#phone_form_close").css({"display": "block"});
    }, function() {
        $("#phone_form_close").css({"display": "none"});
    });

    $("#phone_form_close").click(function() {
        $("#phone_form_close").css({"display": "none"});
        $("#call_connect").animate({"width": "50px"}, 500, function() {
            $("#call_connect").hide();
            $(".phone_icon_singl").show();
        });
    });
	//setTimeout(function(){$("#phone_form_close").click();}, 1000);

    $(window).resize(function() {
        var width = $(window).width();
        if (width <800) {
            $("#call_connect").css({"display": "none"});
        }
        else {
            $("#call_connect").css({"display": "block"});
        }
    });
	
	//cookie for like
	/*
	var like_me_cookie = $.cookie('like_me');
	if(parseInt(like_me_cookie) === 3) {
		setTimeout( function(){ 
			$( "#inline-popups-f a" ).trigger("click");
			$.cookie('like_me', parseInt(like_me_cookie) + 1, { expires: 30, path: '/' });
		}, 5000);
	} else {
		if(like_me_cookie === undefined) {
			$.cookie('like_me', '1', { expires: 30, path: '/' });
		} else {
			if(parseInt(like_me_cookie) === NaN) {
				$.cookie('like_me', '1', { expires: 30, path: '/' });
			} else {
				if(parseInt(like_me_cookie) < 3) {
					$.cookie('like_me', parseInt(like_me_cookie) + 1, { expires: 30, path: '/' });
				}
			}
		}
	}
	*/
	if($.cookie('like_me')!=='10000'){
		setTimeout( function(){ 
			$.cookie('like_me', '10000', { expires: 300, path: '/' });
			$( "#inline-popups-f a" ).trigger("click");
		}, 30000);
	};
	
	
	// Inline popups
	$('#inline-popups, #inline-popups-f').magnificPopup({
	  delegate: 'a',
	  removalDelay: 500, //delay removal by X to allow out-animation
	  callbacks: {
		beforeOpen: function() {
		   this.st.mainClass = this.st.el.attr('data-effect');
		}
	  },
	  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});

//
//// Image popups
//$('#image-popups').magnificPopup({
//  delegate: 'a',
//  type: 'image',
//  removalDelay: 500, //delay removal by X to allow out-animation
//  callbacks: {
//    beforeOpen: function() {
//      // just a hack that adds mfp-anim class to markup 
//       this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
//       this.st.mainClass = this.st.el.attr('data-effect');
//    }
//  },
//  closeOnContentClick: true,
//  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
//});
//
//
//// Hinge effect popup
//$('a.hinge').magnificPopup({
//  mainClass: 'mfp-with-fade',
//  removalDelay: 1000, //delay removal by X to allow out-animation 
//  callbacks: {
//    beforeClose: function() {
//        this.content.addClass('hinge');
//    }, 
//    close: function() {
//        this.content.removeClass('hinge'); 
//    }
//  },
//  midClick: true
//});
//


    /* pagination scroll */

    $(document).on("click", ".product-list-wrapper .pagination a", function() {
        document.getElementById("tfc-menu").scrollIntoView();
    });


});

