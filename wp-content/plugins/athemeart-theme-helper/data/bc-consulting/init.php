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
$data['one-page'] = array(
    'demo_name' => 'One-Page Design',
    'demo_url' => 'https://demo.athemeart.com/bc/demo-1/',
    'categories' => array('Premium'),
    'screenshot' => 'https://demo.athemeart.com/bc/img/screenshot.webp',
    'pro' => 'https://athemeart.com/downloads/bc-business-consulting/', 
);
$data['woocommerce'] = array(
     'demo_name' => 'Shop and Multi-Page Design',
    'demo_url' => 'https://demo.athemeart.com/bc/demo-2/',
     'categories' => array('WooCommerce','Premium'),
    'screenshot' => 'https://demo.athemeart.com/bc/img/screenshot-2.webp',
    'pro' => 'https://athemeart.com/downloads/bc-business-consulting/', 
   
);


