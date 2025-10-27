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

$data['joyas-shop'] = array(
    'demo_name' => 'Joyas Shop',
    'demo_url' => 'https://athemeart.dev/joyas/demo-1/',
    'categories' => array('Premium'),
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-1.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-1.wie' ),
    'screenshot' => 'https://athemeart.dev/joyas/dummy/screenshot-1.png',
    'home_title' => 'Home Jewelry',
    'blog_title' => 'Blog',
    'main_menu_name' => 'Primary Menu',
    'main_menu_location' => 'menu-1',
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

$data['joyas-storefront'] = array(
    'demo_name' => 'Joyas Storefront',
    'demo_url' => 'https://athemeart.dev/joyas/demo-2/',
    'categories' => array('Premium'),
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-2.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-2.wie' ),
    'screenshot' => 'https://athemeart.dev/joyas/dummy/screenshot-2.png',
    'home_title' => 'Main Menu',
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

$data['joyas-jewellery'] = array(
    'demo_name' => 'Joyas Jewellery',
    'demo_url' => 'https://athemeart.dev/joyas/demo-3/',
    'categories' => array('Premium'),
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-3.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-3.wie' ),
    'screenshot' => 'https://athemeart.dev/joyas/dummy/screenshot-3.png',
    'home_title' => 'Home Jewellery',
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

$data['joyas-decor'] = array(
    'demo_name' => 'Joyas Decor Shop',
    'demo_url' => 'https://demo.athemeart.com/joyas/demo-3/',
    'categories' => array('Premium'),
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-4.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-4.wie' ),
    'screenshot' => 'https://athemeart.dev/joyas/dummy/screenshot-4.png',
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
$data['business-agency'] = array(
     'demo_name' => 'Business Agency',
    'demo_url' => 'https://demo.athemeart.com/joyas/demo-4/',
     'categories' => array('Business','Premium'),
    'xml_file' => get_theme_file_uri( 'inc/demo-data/demo-5.xml' ),
    'widgets_file' => get_theme_file_uri( 'inc/demo-data/widgets-5.wie' ),
    'screenshot' => 'https://demo.athemeart.com/joyas/business-agency.png',
    'home_title' => 'Business Home',
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
        ),
    )
);