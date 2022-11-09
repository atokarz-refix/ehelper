<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


add_action('woocommerce_after_add_to_cart_button','rfx_subtitue_yith_wishlist_button');
function rfx_subtitue_yith_wishlist_button(){
    ?>
<div class="rfx_sibtitute_yith_wishlist_button zastepczy_do_ulubionych">
    <span class="icon"><i class="yith-wcwl-icon fa fa-heart-o"></i></span>
</div>
    <?php
}//rfx_subtitue_yith_wishlist_button()