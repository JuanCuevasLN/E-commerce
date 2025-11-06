<?php 
    function enqueueTaxonomyProductCatAssets() {
        if (is_product_category()) {
            wp_enqueue_style(
                'taxonomy-product-cat-css',
                get_stylesheet_directory_uri() . '/assets/css/taxonomyProductCat.css',
                array(),
                '1.0.0'
            );
        }
    }

    add_action('wp_enqueue_scripts', 'enqueueTaxonomyProductCatAssets')
?>