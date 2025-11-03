<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PopularFX
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'popularfx'); ?></a>

        <header id="masthead" class="site-header header quantum-card quantum-border">
            <div class="container-nav">
                    <?php
                    the_custom_logo();
                    if (is_front_page() && is_home()) :
                    ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php
                    else :
                    ?>
                        <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php
                    endif;
                    $popularfx_description = get_bloginfo('description', 'display');
                    if ($popularfx_description || is_customize_preview()) :
                    ?>
                        <p class="site-description"><?php echo $popularfx_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                    ?></p>
                    <?php endif;
                    ?>
                
                <nav class="nav-container main-navigation hidden-mobile" id="site-navigation">
                    <!-- Menu principal -->
                    <div class="main-menu">
                        <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu_principal',
                                    'container'      => false,
                                    'menu_class'     => 'first-content-menu',
                                )
                            );
                        ?>
                    </div>

                    <!-- Menu secundario -->
                    <div class="utility-group">
                        <!-- Busqueda -->

                        <div class="search-container">
                            <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                                <i class="fas fa-search search-icon"></i>
                                <input type="search"
                                    id="woocommerce-product-search-field"
                                    class="search-input search-field"
                                    placeholder="<?php echo esc_attr__('Search products...', 'woocommerce'); ?>"
                                    value="<?php echo get_search_query(); ?>"
                                    name="s" />
                                <input type="hidden" name="post_type" value="product" />
                            </form>
                        </div>

                        <div class="menu-derecho">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu_secundario',
                                    'container'      => false,
                                    'menu_class'     => 'second-content-menu',
                                )
                            );
                            ?>
                        </div>
                    </div>
                </nav>
            </div>

            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="dashicons dashicons-menu-alt2"></span></button>
        </header><!-- #masthead -->