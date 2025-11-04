<?php
    defined('ABSPATH') || exit;
    get_header('shop')
?>

<div class="body">
    <div class="container categories-section">
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

    <div class="container">
        <div class="main-layout">
            <aside class="sidebar">
                <h3 class="sidebar-title">Filtros</h3>

                <!-- Filtro por precio -->
                <div class="filter-group">
                    <h4 class="filter-title">Precio</h4>
                    <div class="filter-content">
                        <label for="precio_min">Mínimo:</label>
                        <input type="number" id="precio_min" name="precio_min" min="0" placeholder="0">

                        <label for="precio_max">Máximo:</label>
                        <input type="number" id="precio_max" name="precio_max" min="0" placeholder="1000">
                    </div>
                </div>

                <!-- Filtro por valoración -->
                <div class="filter-group">
                    <h4 class="filter-title">Valoración</h4>
                    <div class="filter-content">
                        <label><input type="radio" name="valoracion" value="4"> ★★★★ o más</label><br>
                        <label><input type="radio" name="valoracion" value="3"> ★★★ o más</label><br>
                        <label><input type="radio" name="valoracion" value="2"> ★★ o más</label><br>
                        <label><input type="radio" name="valoracion" value="1"> ★ o más</label><br>
                        <label><input type="radio" name="valoracion" value="" checked> Todas</label>
                    </div>
                </div>

                <!-- Filtro por categorías -->
                <div class="filter-group">
                    <h4 class="filter-title">Categorías</h4>
                    <div class="filter-content">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy'   => 'product_cat',
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => true,
                        ));

                        if (!empty($categories) && !is_wp_error($categories)) :
                            foreach ($categories as $cat) :
                                ?>
                                <label>
                                    <input type="checkbox" name="categoria[]" value="<?php echo esc_attr($cat->term_id); ?>">
                                    <?php echo esc_html($cat->name); ?>
                                </label><br>
                                <?php
                            endforeach;
                        else :
                            echo '<p>No hay categorías disponibles.</p>';
                        endif;
                        ?>
                    </div>
                </div>

                <button class="apply-btn" id="id-button-filtros">Aplicar filtros</button>

                <div class="filter-loading" style="display:none;">
                    <span>Cargando productos...</span>
                </div>
            </aside>


            <main class="main-content">
                <div class="sorting-bar"> 
                    <div class="sorting-content">
                        <div class="sorting-left">
                        </div>
                        <div class="view-buttons">
                        </div>
                    </div>
                </div>

                <div class="section-product">
                    <?php 
                        $args_categories = array(
                            'taxonomy'   => 'product_cat',
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => true,
                            'parent'     => 0,
                        );

                        $categories = get_terms($args_categories);

                        if (!empty($categories) && !is_wp_error($categories)) :
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
                            
                                $products_query = new WP_Query($args_products);
                                if ($products_query -> have_posts()) :
                    ?>
                                    <div class="products-section">
                                        <h3 class="section-title"><?php echo esc_html($category -> name) ?></h3>
                                        <div class="products-grid">
                    <?php 
                                            while($products_query->have_posts()) : $products_query->the_post();
                                                wc_get_template_part('content', 'product');
                                            endwhile;
                    ?>  
                                        </div>
                                    </div>
                    <?php
                                endif;
                            endforeach;
                        endif;
                    ?>    
                </div>                                
            </main>
        </div>
    </div>

    <div>
        <?php woocommerce_pagination(); ?>
    </div>
    </div> 
<?php


get_footer('shop');
?>