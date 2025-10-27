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
                'slug' => 'elementor',
                'init' => 'elementor/elementor.php',
                'name' => 'Elementor',
            ),
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
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-1.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-1.wie' ),
    'screenshot' => get_theme_file_uri( 'assets/image/screenshot.webp' ),
    'home_title' => 'Home',
    'blog_title' => 'Blog',
    'posts_to_show' => '8',
    'default_page_template' => 'elementor_header_footer',
    'required_plugins' => array(
        'free' => array(
            array(
                'slug' => 'elementor',
                'init' => 'elementor/elementor.php',
                'name' => 'Elementor',
            ),
            array(
                'slug' => 'woocommerce',
                'init' => 'woocommerce/woocommerce.php',
                'name' => 'WooCommerce',
            ),
          
        ),
    )
);

$data['veterinary'] = array(
     'demo_name' => 'Pet Veterinary',
    'demo_url' => 'https://demo.athemeart.com/the9-store/demo-3/',
     'categories' => array('WooCommerce','Premium'),
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-3.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-3.wie' ),
    'screenshot' => 'https://demo.athemeart.com/the9-store/img/the9-veterinary.webp',
    'home_title' => 'Veterinary Home',
    'blog_title' => 'Blog',
    'posts_to_show' => '8',
    'default_page_template' => 'elementor_header_footer',
    'required_plugins' => array(
        'free' => array(
            array(
                'slug' => 'elementor',
                'init' => 'elementor/elementor.php',
                'name' => 'Elementor',
            ),
            array(
                'slug' => 'woocommerce',
                'init' => 'woocommerce/woocommerce.php',
                'name' => 'WooCommerce',
            ),
        ),
    )
);
$data['fashion'] = array(
     'demo_name' => 'Fashion Store',
    'demo_url' => 'https://demo.athemeart.com/the9-store/demo-2/',
     'categories' => array('WooCommerce','Premium'),
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-2.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-2.wie' ),
    'screenshot' => get_theme_file_uri( 'assets/image/screenshot-2.webp' ),
    'home_title' => 'Home',
    'blog_title' => 'Blog',
    'posts_to_show' => '8',
    'default_page_template' => 'elementor_header_footer',
    'required_plugins' => array(
        'free' => array(
            array(
                'slug' => 'elementor',
                'init' => 'elementor/elementor.php',
                'name' => 'Elementor',
            ),
            array(
                'slug' => 'woocommerce',
                'init' => 'woocommerce/woocommerce.php',
                'name' => 'WooCommerce',
            ),
        ),
    )
);


