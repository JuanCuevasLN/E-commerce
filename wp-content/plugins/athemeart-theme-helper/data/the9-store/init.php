<?php
/**
 * Demos
 *
 * @package Demo Content for shopstore
 * @author aThemeArt
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
$theme = wp_get_theme();

            // Demos url
$url = 'https://demo.athemeart.com/demo-import/' . $theme->template . '/';

$data['blog'] = array(
    'demo_name' => 'Simple Free Version',
    'demo_url' => 'https://demo.athemeart.com/bc/demo-1/',
    'categories' => array('free'),
    'screenshot' => 'https://demo.athemeart.com/the9-store/free-demo-screenshot.webp',
    'xml_file' => esc_url(_FREE_VERSION_DATA),
    'required_plugins' => array(
        'free' => array(
            array(
                'slug' => 'woocommerce',
                'init' => 'woocommerce/woocommerce.php',
                'name' => 'WooCommerce',
            ),
          
        ),
    )
);

$data['gadget'] = array(
    'demo_name' => 'Gadget Store',
    'demo_url' => 'https://demo.athemeart.com/the9-store/demo-1/',
    'categories' => array('Premium','WooCommerce'),
    'screenshot' => 'https://demo.athemeart.com/the9-store/img/screenshot.webp',
    'pro' => 'https://athemeart.com/downloads/the9-store-pro/',
);
$data['fashion'] = array(
     'demo_name' => 'Fashion Store',
    'demo_url' => 'https://demo.athemeart.com/the9-store/demo-2/',
    'categories' => array('WooCommerce','Premium'),
    'screenshot' => 'https://demo.athemeart.com/the9-store/img/screenshot-2.webp',
     'pro' => 'https://athemeart.com/downloads/the9-store-pro/',
);

function the9_store_after_import_setup() {
    $shop_page = get_page_by_path( 'shop-3' );
    if ( $shop_page ) {
        // Set the Shop page ID
        update_option( 'woocommerce_shop_page_id', $shop_page->ID );
    }
}
add_action('athemeart_theme_after_import', 'the9_store_after_import_setup',999);
