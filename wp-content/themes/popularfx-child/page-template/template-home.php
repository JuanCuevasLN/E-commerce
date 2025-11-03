<?php

/**
 * Template Name: Home QuantumStore
 */
$tamaño = 0;
get_header(); ?>

<div id="quantum-home-page" class="quantum-home-page">
    <section class="quantum-welcome">
        <div class="container-flex">
            <div class="welcome-content">
                <p class="tittle">
                    <b>E-commerce</b>:
                    Lo mejor en productos
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

    <section class="quantum-categories">
        <div class="categories-header">
            <h2 class="categories-title">Categorías Destacadas</h2>
        </div>

        <div class="carousel-wrapper">
            <div class="carousel-track">
                <?php
                $args = array(
                    'taxonomy'   => 'product_cat',
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'hide_empty' => false,
                    'parent'     => 0,
                    'number'     => 12
                );

                $categories = get_terms($args);
                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        $tamaño++;
                        if ($category->name != 'Sin categorizar') {
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : wc_placeholder_img_src();
                            $cat_link = get_term_link($category);
                            $count = $category->count;
                    ?>
                            <div class="carousel-card">
                                <div class="card-image-container">
                                    <a href="<?php echo esc_url($cat_link); ?>" class="category-link">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                    </a>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title"><?php echo esc_html($category->name); ?></h3>
                                    <p class="card-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dolorem facere eaque repellendus autem</p>
                                    <p class="card-price"><?php echo $count; ?> <?php echo $count === 1 ? 'producto' : 'productos'; ?></p>
                                </div>
                            </div>
                    <?php    
                        }
                    }
                } else {
                    echo '<p class="no-categories">No hay categorías disponibles.</p>';
                }
                ?>
            </div>

            <button class="carousel-button prev" aria-label="Anterior">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
		        </svg>
            </button>
            <button class="carousel-button next" aria-label="Siguiente">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
		        </svg>
            </button>
            
            <div class="carousel-indicators">
                <?php 
                    for ($i = 0; $i < $tamaño - 1; $i++) {
                        if ($i == 0) {         
                ?>
                            <div class="indicator active"></div>
                <?php 
                        } else {
                ?>
                            <div class="indicator"></div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </section>

    <section class="shopping-experience">
        <div class="experience-header">
            <h2>¿Por que utilizarnos?</h2>
        </div>
        <div class="experience-content">
            <div class="content-one">

            </div>
            <div class="content-two">

            </div>
            <div class="content-trhee">

            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>