<?php 
    function enqueueContentSingleProductAssets() {
        if (is_product()) {
            wp_enqueue_style(
                'content-single-product-css',
                get_stylesheet_directory_uri() . '/assets/css/contentSingleProduct.css',
                array(),
                '1.0.0',
            );
        }
    }

    add_action('wp_enqueue_scripts', 'enqueueContentSingleProductAssets');
?>