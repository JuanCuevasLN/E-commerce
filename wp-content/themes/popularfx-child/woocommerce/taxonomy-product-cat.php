<?php 
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */
    if ( ! defined( 'ABSPATH' ) ) {
	    exit; // Exit if accessed directly.
    }

    get_header('shop')
?>

<body>
    <?php 
        $term = get_queried_object();
        $term_name = $term->name;
        $term_id = $term->term_id;
        $term_desc = $term->description;
    ?>
    
    <section class="hero">
        <div class="hero-container">
            <h1><?php echo esc_html($term->name); ?></h1>
            <p><?php echo esc_html($term->description); ?></p>
            <nav class="breadcrumbs">
                    
            </nav>
        </div>
    </section>

    <section class="container">
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

                <button class="apply-btn" id="id-button-filtros">Aplicar filtros</button>
            </aside>

            <main class="main-content">
                <div class="sorting-bar">
                    <div class="sorting-content">
                        <div class="sorting-left">
                            <span class="sorting-label">Ordenar por: </span>
                            <select name="ordenar" id="ordenar" class="sorting-select">
                                <option value="" select>...</option>
                                <option value="date_desc">Más recientes</option>
                                <option value="price_asc">Precio: menor a mayor</option>
                                <option value="price_desc">Precio: mayor a menor</option>
                                <option value="rating_desc">Mejor valorados</option>
                                <option value="title_asc">Nombre A-Z</option>
                            </select>
                        </div>
                        <div class="view-toggle">
                            <button class="view-btn active">
                                <i class="fa-solid fa-th-large"></i>
                            </button>
                            <button class="view-btn">
                                <i class="fa-solid fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="section-products">
                    <?php 
                        $products_query = array(
                            'post_type' => 'product',
                            'posts_per_page' => 12,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $term_id,
                                )
                            )
                        );

                        $products = new WP_Query($products_query);

                        if ($products->have_posts()) :
                            while ($products->have_posts()) : $products->the_post();
                                wc_get_template_part('content', 'product');
                            endwhile;
                        else :
                            echo '<p>No hay productos disponibles en esta categoría.</p>';
                        endif;
                    ?>
                </div>
            </main>
        </div>
    </section>
</body>

<?php 
    get_footer('shop');
?>