<?php 
    if (! function_exists( 'wc_custom_dropdown_variation_attribute_options' )) {
        function wc_custum_dropdown_variation_attribute_options( $args = array()) {
            $args = wp_parse_args(
                apply_filters( 'woocommere_dropdown_variation_attribute_options_args', $args),
                array(
                    'options' => false,
                    'attribute' => false,
                    'product' => false,
                    'selected' => false,
                    'required' => false,
                    'name' => '',
                    'aria-label' => false,
                    'id' => '',
                    'class' => '',
                    'show_option_none' => __('Choose an option', 'woocommerce'),
                )
            );

            if ( false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
                $selected_key = 'attribute_' . sanitize_title( $args['attribute'] );
                $args['selected'] = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key] ) ) : $args['product']->get_variation_default_attribute( $args['attribute'] );
            }

            $options                = $args['options'];
            $product               = $args['product'];
            $attribute             = $args['attribute'];
            $name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
            $id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
            $class                 = $args['class'];
            $required              = (bool) $args['required'];
            $show_option_none      = (bool) $args['required'];
            $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');
            
            if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
                $attributes = $product->get_variation_attributes();
                $options = $attributes[ $attribute ];
            }

            if ($attribute == 'Color') {
                $MapColors = [
                    'gris' => '#7a7a7a',
                    'azul' => '#3facf4',
                    'rojo' => '#f43f5e',
                    'verde' => '#1cc261',
                ];

                // Select oculto (necesario para WooCommerce)
                $html = '<select id="' . esc_attr( $id ) . '" class="hidden-select ' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . ( $args['aria-label'] ? '" aria-label="' . esc_attr( $args['aria-label'] ) : '' ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '"' . ( $required ? ' required' : '' ) . ' style="display:none;">';
                
                if ( $show_option_none ) {
                    $html .= '<option value="">' . esc_html( $show_option_none_text ) . '</option>';
                }

                $html .= '</select>';

                // Contenedor de botones
                $html .= '<div class="color-options" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute )) . '">';
                
                if ( !empty( $options ) ) {
                    if ( $product && taxonomy_exists( $attribute )) {
                        // Con taxonomía
                        $terms = wc_get_product_terms (
                            $product->get_id(),
                            $attribute,
                            array(
                                'fields' => 'all',
                            )
                        );
    
                        foreach ( $terms as $term ) {
                            if ( in_array( $term->slug, $options, true ) ) {
                                $selected_class = sanitize_title( $args['selected'] ) === $term->slug ? ' active' : '';
                                $color_value = isset( $MapColors[ strtolower( $term->name ) ] ) ? $MapColors[ strtolower( $term->name )] : '#ccc';
                                
                                $html .= '
                                    <button type="button" class="color-btn' . $selected_class . '" data-value="' . esc_attr( $term->slug ) . '">
                                        <div class="color-swatch" style="background-color:' . esc_attr( $color_value ) . '"></div>
                                        <span>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) . '</span>
                                    </button>
                                ';
                                
                                // Agregar opción al select oculto
                                $html = str_replace('</select>', '<option value="' . esc_attr( $term->slug ) . '"' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( $term->name ) . '</option></select>', $html);
                            }
                        }
                    } else {
                        // Sin taxonomía
                        foreach ( $options as $option ) {
                            $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
                            $selected_class = strpos($selected, 'selected') !== false ? ' active' : '';
                            $color_value = isset( $MapColors[ strtolower( $option ) ] ) ? $MapColors[ strtolower( $option )] : '#ccc';

                            $html = str_replace('</select>', '<option value="' . esc_attr( $option ) . '"' . $selected . '>' . esc_html( ucfirst( $option ) ) . '</option></select>', $html);
                            
                            $html .= '
                                <button type="button" class="color-btn' . $selected_class . '" data-value="' . esc_attr( $option ) . '">
                                    <div class="color-swatch" style="background-color:' . esc_attr( $color_value ) . '"></div>
                                </button>
                            ';
                        }
                    }
                }
                $html .= '</div>';   
                echo apply_filters( 'woocommerce_dropdown_variantion_attribute_options_html', $html, $args);
            }          
        }
    }
?>