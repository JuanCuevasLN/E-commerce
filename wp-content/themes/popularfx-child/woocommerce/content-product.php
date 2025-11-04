<?php 
    defined( 'ABSPATH' ) || exit;

    global $product;

    if (! is_a( $product, WC_Product::class ) || ! $product->is_visible()) {
        return;
    }
?>


<div <?php wc_product_class('product-card', $product)  ?>>
    <?php 
        /**
	    * Hook: woocommerce_before_shop_loop_item.
	    *
	    * @hooked woocommerce_template_loop_product_link_open - 10
	    */
	    do_action( 'woocommerce_before_shop_loop_item' );
    ?>
    <div class="product-image-container">
        <?php 
            /**
	        * Hook: woocommerce_before_shop_loop_item_title.
	        *
	        * @hooked woocommerce_show_product_loop_sale_flash - 10
	        * @hooked woocommerce_template_loop_product_thumbnail - 10
	        */
	        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
    </div>
    <div class="product-info">
        <?php 
            /**
	            * Hook: woocommerce_shop_loop_item_title.
	            *
	            * @hooked woocommerce_template_loop_product_title - 10
	        */
	        do_action( 'woocommerce_shop_loop_item_title' );
        ?>
        <div class="product-rating">
            <?php 
                woocommerce_template_loop_rating()
            ?>
        </div>

        <div class="product-footer">
            <?php 
                woocommerce_template_loop_price(); 
            ?>
        </div>
    </div>
    <?php 
	    /**
	    * Hook: woocommerce_after_shop_loop_item.
	    *
	    * @hooked woocommerce_template_loop_product_link_close - 5
	    * @hooked woocommerce_template_loop_add_to_cart - 10
	    */
	    do_action( 'woocommerce_after_shop_loop_item' );
    ?>
</div>
