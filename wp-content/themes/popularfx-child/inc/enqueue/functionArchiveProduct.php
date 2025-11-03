<?php
function enqueueArchiveProductAssets() {
    if (is_post_type_archive('product') || is_shop()) {
        wp_enqueue_style(
            'archive-product-css',
            get_stylesheet_directory_uri() . '/assets/css/archiveProduct.css',
            array(),
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueueArchiveProductAssets');
?>
