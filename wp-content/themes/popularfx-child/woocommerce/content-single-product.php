<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'main', $product ); ?>>
		<div class="product-grid">
			<div class="thumbnails">

			</div>

			<div class="main-image">
				<?php
					/**
					* Hook: woocommerce_before_single_product_summary.
					*
					* @hooked woocommerce_show_product_sale_flash - 10
					* @hooked woocommerce_show_product_images - 20
					*/
					do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>

			<div class="product-info">
				<div>
					<div class="category-badge"><?php woocommerce_template_single_meta();?></div>
					<?php woocommerce_template_single_title(); ?>
					<div class="rating"><?php woocommerce_template_single_rating(); ?></div>
				</div>

				<div class="divider">
					<div class="price-section">
						<div class="price"><?php woocommerce_template_single_price() ?></div>
					</div>

					<div class="points-card">
                    	<div class="points-header">
                        	<div class="points-title">
                            	<i class="fa-solid fa-coins"></i>
                            	<span>Pagar con Puntos Quantum</span>
                        	</div>
                        	<span class="points-value">29,999 pts</span>
                    	</div>
                    	<div class="points-info">1 punto = $0.5 MX • Tienes 5,420 puntos disponibles</div>
                    	<button class="points-btn">Combinar Puntos + Efectivo</button>
                	</div>
				</div>

				<div class="divider">
                	<p class="description">
						<?php woocommerce_template_single_excerpt() ?>
                	</p>
            	</div>

				<div class="stock-info">
                	<div class="in-stock">
						<?php 
							if ($product->is_in_stock()) {
						?>
							<i class="fa-solid fa-circle-check"></i>
                    		<span>En Stock</span>
						<?php 
							} else {
						?>
							<i class="fa-solid fa-circle-xmark"></i>
                    		<span>Agotado</span>
						<?php
							}
						?>
                	</div>
            	</div>

				<div class="divider">
					<?php woocommerce_template_single_add_to_cart() ?>
				</div>

		    </div>
		</div>

		<?php woocommerce_output_product_data_tabs() ?>
	</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
