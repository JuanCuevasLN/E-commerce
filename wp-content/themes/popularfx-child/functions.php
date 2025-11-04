<?php

    /**
     * Responsive Child Theme functions and definitions
     * @package ResponsiveChild
     * @author Juan de la Cruz
     * @version 1.0.0
     * @since 1.0.0
     */

    // Exit if accessed directly.
    if (! defined('ABSPATH')) {
        exit;
    }

    // Cargar Funciones
    require get_stylesheet_directory() . '/inc/menu.php';
    function agregar_font_awesome()
    {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    }
    add_action('wp_enqueue_scripts', 'agregar_font_awesome');

    require_once get_stylesheet_directory() . '/inc/replace-text-with-icons.php';

    $enqueue_dir = get_stylesheet_directory() . '/inc/enqueue/';
    foreach (glob($enqueue_dir . '*.php') as $file) {
        require_once $file;
    }

    /**
     * Cargar estilos del tema padre y del hijo
     */
    function popularfx_child_enqueue_styles()
    {
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

    function enqueue_filtros_ajax_script() {
        wp_enqueue_script(
            'filtros-ajax', // identificador
            get_stylesheet_directory_uri() . '/assets/js/filtros-ajax.js', // ruta
            array('jquery'), // dependencias
            '1.0.0',
            true // cargar al final del body
        );

        // Inyectamos las variables PHP para el JS
        wp_localize_script('filtros-ajax', 'wp_vars', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
    }
    add_action('wp_enqueue_scripts', 'enqueue_filtros_ajax_script');






    function filtrar_productos_callback()
    {
        $filtros = $_POST['filtros'];

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 10,
            'post_status' => 'publish',
        );

        // Filtro por precio
        if (!empty($filtros['precio_min']) && !empty($filtros['precio_max'])) {
            $args['meta_query'][] = array(
                'key' => '_price',
                'value' => array($filtros['precio_min'], $filtros['precio_max']),
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            );
        }

        // Filtro por categoría
        if (!empty($filtros['categorias'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $filtros['categorias'],
            );
        }

        // Filtro por valoración
        if (!empty($filtros['valoracion'])) {
            $args['meta_query'][] = array(
                'key' => '_wc_average_rating',
                'value' => floatval($filtros['valoracion']),
                'compare' => '>=',
                'type' => 'NUMERIC'
            );
        }

        $query = new WP_Query($args);

        ob_start();

        if ($query->have_posts()) {
            echo '<div class="products-grid">';
            while ($query->have_posts()) {
                $query->the_post();
                wc_get_template_part('content', 'product');
            }
            echo '</div>';
        } else {
            echo '<p>No se encontraron productos con los filtros seleccionados.</p>';
        }

        wp_reset_postdata();
        wp_send_json_success(ob_get_clean());
    }
    add_action('wp_ajax_filtrar_productos', 'filtrar_productos_callback');
    add_action('wp_ajax_nopriv_filtrar_productos', 'filtrar_productos_callback');
