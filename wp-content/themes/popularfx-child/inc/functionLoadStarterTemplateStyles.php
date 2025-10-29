<?php 
    function quantum_home_assets () {
        // Verifica si es la página de inicio
        if (is_front_page() || is_page_template('page-templates/template-home.php')) {
            //CSS
            wp_enqueue_style(
                'quantum-home-css',
                get_stylesheet_directory_uri() . '/assets/css/home.css',
                array(),
                '1.0.0'
            );

            wp_enqueue_script(
                'quantum-home-js',
                get_stylesheet_directory_uri() . '/assets/js/home.js',
                array('jquery'),
                '1.0.0',
                true
            );
        }
    }

    add_action('wp_enqueue_scripts', 'quantum_home_assets');
?>