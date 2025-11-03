<?php
    defined('ABSPATH') || exit;
    get_header('shop')
?>
    <div class="body">
        <div class="categories-container">
            <div class="categories-card">
                <h2 class="categories-title">Categorías Principales</h2>
                <div class="categories-grid">
                    <?php 
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'hide_empty' => false,
                            'parent' => 0,
                            'number' => 12
                        );

                        $categories = get_terms($args);
                        if (!empty($categories) && !is_wp_error($categories)) {
                            foreach($categories as $category) {
                                if ($category->name != 'Sin categorizar') {
                                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                    $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : wc_placeholder_img_src();
                                    $cat_link = get_term_link($category);
                                    $count = $category->count;
                    ?>
                                    <div class="category-item">
                                        <h3> <?php echo esc_html($category->name); ?> </h3>
                                        <p> <?php echo $count; ?> <?php echo $count === 1 ? 'producto' : 'productos'; ?> </p>
                                    </div>
                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="main-wrapper">
            <aside class="sidebar">
                <h3 class="sidebar-title">Filtros</h3>

                <div class="filter-section">
                </div>

                <div class="filter-section">
                </div>

                <div class="filter-section">
                </div>

                <button class="apply-filters-btn">
                    Aplicar filtros
                </button>
            </aside>

            <main class="content-main">
                <div class="sorting-bar"> 
                    <div class="sorting-left">
                    </div>
                    <div class="sorting-right">

                    </div>
                </div>
                
                <div class="products-grid">
                    <?php 
                        //$get_filtros = obtener_filtros_activos();

                        $args_categories = array(
                            'taxonomy'   => 'product_cat',
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => true,
                            'parent'     => 0,
                        );

                        $categories = get_terms($args_sategories);

                        if (!empty($categories) && !is_wp_error($categories)) {
                            foreach ($categories as $category) :
                                $args_products = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => 10,
                                    'post_status' => 'publish',
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'term_id',
                                            'terms' => $category->term_id,
                                        )
                                    )
                                );
                                
                                //$args_products = aplicar_filtros_woocommerce($args_products, $get_filtros);

                                $products_query = new WP_Query($args_products);
                                if ($products_query -> have_posts()) :
                    ?>
                                    <div class="products-section">
                                        <h3 class="section-title"><?php echo esc_html($category -> name) ?></h3>
                    <?php 
                                        while($products_query->have_posts()) : $products_query->the_post();
                                            wc_get_template_part('content', 'product');
                                        endwhile;
                    ?>
                                    </div>
                    <?php
                                endif;
                            endforeach;
                        } else {
                            echo '<p>No hay categorías disponible. </p>';
                        }
                    ?>
                </div>
            </main>
        </div>

        <div>
            <?php woocommerce_pagination(); ?>
        </div>
    </div> 
<?php


get_footer('shop');
?>