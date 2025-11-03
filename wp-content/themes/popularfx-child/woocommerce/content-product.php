<?php 
    defined( 'ABSPATH' ) || exit;

    global $product;

    if (! is_a( $product, WC_Product::class ) || ! $product->is_visible()) {
        return;
    }
?>

<div <?php wc_product_class('products-section', $product)  ?>>

</div>