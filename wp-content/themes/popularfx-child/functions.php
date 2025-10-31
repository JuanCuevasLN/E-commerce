<?php 

/**
 * Responsive Child Theme functions and definitions
 * @package ResponsiveChild
 * @author Juan de la Cruz
 * @version 1.0.0
 * @since 1.0.0
 */

    // Exit if accessed directly.
    if ( ! defined( 'ABSPATH' ) ) {
	    exit;
    }


    // Cargar Funciones
    require get_stylesheet_directory() . '/inc/menu.php';
    function agregar_font_awesome() {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');  
    }
    add_action('wp_enqueue_scripts', 'agregar_font_awesome');

    require_once get_stylesheet_directory() . '/inc/replace-text-with-icons.php';
    require_once get_stylesheet_directory() . '/inc/functionLoadStarterTemplateStyles.php';

    /**
     * Cargar estilos del tema padre y del hijo
     */
    function popularfx_child_enqueue_styles() {
        // Carga primero el CSS del tema padre
        wp_enqueue_style(
            'popularfx-parent-style',
            get_template_directory_uri() . '/style.css'
        );

        // Luego carga el CSS del tema hijo
        wp_enqueue_style(
            'popularfx-child-style',
            get_stylesheet_directory_uri() . '/style.css',
            array('popularfx-parent-style')
        );
    }
    add_action('wp_enqueue_scripts', 'popularfx_child_enqueue_styles');
