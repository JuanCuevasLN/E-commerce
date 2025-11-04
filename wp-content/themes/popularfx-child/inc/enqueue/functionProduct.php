<?php

function enqueueProductAssets() {
    if (is_post_type_archive('product') || is_shop()) {
        wp_enqueue_style(
            'products-css',
            get_stylesheet_directory_uri() . '/assets/css/products.css',
            array(),
            '1.0.0'
        );

        wp_enqueue_script(
            'quantum-home-js',
            get_stylesheet_directory_uri() . '/assets/js/filtros-ajax.js',
            array(),
            '1.0.0',
            true
        );
    }
}

add_action('wp_enqueue_scripts', 'enqueueProductAssets');

?>