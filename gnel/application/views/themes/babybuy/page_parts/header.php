<?php
$cart['total'] = 0;
$cart['quantity'] = 0;
$cart['html'] = '<table><tbody>';
foreach ($shopping_cart AS $product) {

    $subtotal = intval($product->total_amount);
	$cart['total'] += $subtotal;
	$cart['quantity'] += intval($product->quantity);
	$product_url = product_url($product->id, $product->name);
	$image_url = prodImg($product->id, $product->image);
	$thumb_url = thumbImg($image_url, 50, 50);

	$cart['html'] .= '<tr>';
	$cart['html'] .= '<td class="image"><a href="' . $product_url . '"><img src="' . $thumb_url . '" alt="' . $product->name . '" title="' . $product->name . '"></a></td>';
	$cart['html'] .= '<td class="name"><a href="' . $product_url . '"><span class="mini-cart-product-name">' . $product->name . '<span/></a>';
	$cart['html'] .= '<div> </div></td>';
	$cart['html'] .= '<td class="quantity">x&nbsp;' . $product->quantity . '</td>';
	$cart['html'] .= '<td class="total">' . $cart['total'] . ' ' . $this->lang->line('AMD') . '</td>';
	$cart['html'] .= '<td class="remove"><img src="' . base_url('images/icons/remove-small.png') . '" alt="' . $this->lang->line('Remove') . '" title="' . $this->lang->line('Remove') . '" product-id="' . $product->id . '"></td>';
	$cart['html'] .= '</tr>';
}
$cart['html'] .= '</tbody></table>';
?>


<div id="header">
    <div id="logo">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>themes/babybuy/image/babybuy_logo.png" title="Մանկական օնլայն խանութ" alt="Մանկական օնլայն խանութ">
        </a>
    </div>
    <div id="header_right">
        <form action="index.html" method="post" enctype="multipart/form-data">
            <div id="language">
                <ul class="currence">
					<?php $lang = $this->config->item('language'); ?>
                    <li class="first_item">
                        <a <?php echo $lang == "am" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('am'); ?>"  title="Հայերեն">AM</a>
                    </li>
                    <li>
                        <a <?php echo $lang == "ru" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('ru'); ?>" title="Русский">RU</a>
                    </li>
                    <li class="last_item">
                        <a <?php echo $lang == "en" ? 'class="selected"' : ''; ?> href="<?php echo createMultilangUrl('en'); ?>" title="English">EN</a>
                    </li>
                </ul>
            </div>
        </form>


        <div class="search">
            <div class="button-search"><a href="<?php echo site_url('product/search/'); ?>" class='search-link'><i class="fa fa-search fa-fw"></i></a></div>
            <input type="text" name="search" placeholder="<?php echo $this->lang->line('Search'); ?>" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
        </div>
        <div id="cart">
            <div class="heading">
                <div class="button-cart"><i class="fa fa-shopping-cart fa-fw shopping-basket"></i></div>
                <div class="cart_top_in">
                    <h4><?php echo $this->lang->line('Shopping Cart'); ?></h4>
                    <a><span id="cart-total">
                            <span><?php echo $this->lang->line('AMD'); ?></span><span class="cart-total-amount"><?php echo $cart['total']; ?></span>
                            <span><?php echo $this->lang->line('item(s)'); ?> - </span> 
                            <span class="cart-total-count"><?php echo $cart['quantity']; ?></span>
                        </span></a>
                </div>
            </div>
            <div class="content">
                <div class="mini-cart-info">
					<?php echo $cart['html']; ?>
                </div>
                <div class="mini-cart-total">
                    <table>
                        <tbody>
                            <tr class="last_item">
                                <td class="right"><b><?php echo $this->lang->line('Total:'); ?></b></td>
                                <td class="right"><span class="cart-total-amount"><?php echo $cart['total']; ?></span><?php echo $this->lang->line('AMD'); ?><span></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="checkout"><a class="button mr" href="<?php echo site_url('shopping/cart'); ?>"><?php echo $this->lang->line('View Cart'); ?></a><a class="button" href="<?php echo site_url('shopping/checkout'); ?>"><?php echo $this->lang->line('Checkout'); ?></a></div>
            </div>
        </div>

        <div id="bottom_right">
			<? if (isset($logged) && $logged) { ?>
				<? if (!isset($home_page)) {  ?>
					<p id="welcome_log"> <?php // echo $this->lang->line('Welcome');  ?>  <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name').' '; ?><a href="<?php echo site_url('account/points'); ?>" class="user_points"><?php echo  !$this->session->userdata('total_points') ? '  <span>0</span> ' : '<span>'.$this->session->userdata('total_points').'</span> '; echo $this->lang->line('Points'); ?></a></p>
				<?php } ?>
			<?php } else { ?>
				<p id="welcome"> <?php echo $this->lang->line('Welcome visitor you can'); ?> <a href="<?php echo site_url('account/login'); ?>"><?php echo $this->lang->line('WLogin'); ?></a> <?php echo $this->lang->line('or'); ?> <a href="<?php echo site_url('account/register'); ?>"><?php echo $this->lang->line('create an account'); ?></a>. </p>
			<?php } ?>
            <div class="links">
                <a class="first_ch" href="<?php echo site_url('account'); ?>"><?php echo $this->lang->line('My Account'); ?></a>
                <a href="<?php echo site_url('shopping/cart'); ?>"><?php echo $this->lang->line('Shopping Cart'); ?></a>
                <a href="<?php echo site_url('shopping/checkout'); ?>"><?php echo $this->lang->line('Checkout'); ?></a>

				<? if (isset($logged) && $logged) { ?>
					<a href="<?php echo site_url('account/logout'); ?>"><?php echo $this->lang->line('Exit'); ?></a>
				<?php } ?>
				<?php if ((!isset($logged) || (isset($logged) && !$logged))) { ?>
					<div id="inline-popups"><a href="#test-popup" data-effect="mfp-zoom-in"><?php echo $this->lang->line('Why register'); ?></a> </div>
					<div id="test-popup" class="white-popup mfp-with-anim mfp-hide">
						<h4><?php echo $this->lang->line('By registering you can'); ?></h4>
						<ul >
							<li> <?php echo $this->lang->line('Why register text1'); ?></li>
							<li> <?php echo $this->lang->line('Why register text2'); ?></li>
							<li> <?php echo $this->lang->line('Why register text3'); ?></li>
							<li> <?php echo $this->lang->line('Why register text4'); ?></li>
                            <li> <a href="<?php echo site_url('page/points'); ?>"><?php echo $this->lang->line('Why register text5'); ?></a></li>
						</ul>
					</div>
				<? } ?>

			
					<div id="inline-popups-f" style="display: none;"><a href="#f-popup" data-effect="mfp-zoom-in">facebook like</a> </div>
					<div id="f-popup" class="white-popup mfp-with-anim mfp-hide face_like_popap">
						<div class="if_like_text">
							<h2><?php echo $this->lang->line('If like our site, please like it'); ?></h2>
						</div>

						<div class="fb-like" data-href="https://facebook.com/babybuy.am" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
					</div>

            </div>
        </div>
    </div>
</div>

