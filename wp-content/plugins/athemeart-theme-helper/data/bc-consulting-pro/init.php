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
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-1.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-1.wie' ),
    'screenshot' => get_theme_file_uri( 'assets/images/screenshot.webp' ),
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
                'slug' => 'contact-form-7',
                'init' => 'contact-form-7/wp-contact-form-7.php',
                'name' => 'Contact Form 7',
            ),
          
        ),
    )
);


$data['woocommerce'] = array(
     'demo_name' => 'Shop and Multi-Page Design',
    'demo_url' => 'https://demo.athemeart.com/bc/demo-2/',
     'categories' => array('WooCommerce','Premium'),
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-2.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-2.wie' ),
    'screenshot' => get_theme_file_uri( 'assets/images/screenshot-2.webp' ),
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
            array(
                'slug' => 'contact-form-7',
                'init' => 'contact-form-7/wp-contact-form-7.php',
                'name' => 'Contact Form 7',
            ),
          
        ),
    )
);


