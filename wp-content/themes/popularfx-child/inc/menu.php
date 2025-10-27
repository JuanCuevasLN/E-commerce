<?php 
    function my_menus() {
        register_nav_menus(
            array(
                'menu_principal' => __( 'Menu principal'),
                'menu_secundario' => __( 'Menu secundario' ),
            )
        );
    }
    add_action('after_setup_theme', 'my_menus');
?>