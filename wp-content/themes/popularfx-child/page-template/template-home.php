<?php
/**
 * Template Name: Home QuantumStore
 */

get_header(); ?>

<div id="quantum-home-page" class="quantum-home-page">
    <section class="quantum-welcome">
        <div class="container-flex">
            <div class="welcome-content">
                <p class="tittle">
                    <b>E-commerce</b>: 
                    Lo mejor de tecnologia
                </p>
                <p class="description">
                    Disfrute de una experiencia de compra a nivel cuántico con productos de vanguardia y tecnología inmersiva que redefine el comercio electrónico.
                </p>
                <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn-gradient">
                    Explorar productos
                </a>
            </div>
            <div class="welcome-image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero.png" alt="Welcome">
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>