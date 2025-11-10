jQuery(function($) {
    // Observer para mover thumbnails
    const targetNode = document.querySelector('.woocommerce-product-gallery');
    if (targetNode) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                $(mutation.addedNodes).each(function() {
                    if ($(this).hasClass('flex-control-nav') && $(this).hasClass('flex-control-thumbs')) {
                        const newContainer = $('.thumbnails');
                        if (newContainer.length) {
                            newContainer.append(this);
                            observer.disconnect();
                        }
                    }
                });
            });
        });
        observer.observe(targetNode, { childList: true, subtree: true });
    }

    // Manejador de clicks en botones de color
    $(document).on('click', '.color-btn', function(e) {
        e.preventDefault();
        
        const $btn = $(this);
        const value = $btn.attr('data-value');
        const $container = $btn.closest('.variations').length ? $btn.closest('.variations') : $btn.closest('form.cart');
        const $select = $container.find('select[data-attribute_name="attribute_color"]');
        
        if (!$select.length) {
            console.error('No se encontró el select de color');
            return;
        }
        
        // Remover clase active de todos los botones en este grupo
        $btn.siblings('.color-btn').removeClass('active');
        $btn.removeClass('active');
        
        // Agregar clase active al botón clickeado
        $btn.addClass('active');
        
        // Cambiar el valor del select y disparar el evento change
        $select.val(value).trigger('change');
        
        // Forzar actualización de variaciones de WooCommerce
        $container.find('.variations_form').trigger('check_variations');
        
        console.log('Color seleccionado:', value);
    });
    
    // Sincronizar selección inicial cuando carga la página
    $('.color-options').each(function() {
        const $container = $(this);
        const $select = $container.siblings('select.hidden-select');
        const selectedValue = $select.val();
        
        if (selectedValue) {
            $container.find('.color-btn[data-value="' + selectedValue + '"]').addClass('active');
        }
    });
    
    // Observar cambios en el select (por si WooCommerce lo actualiza)
    $(document).on('change', 'select[data-attribute_name="attribute_color"]', function() {
        const $select = $(this);
        const value = $select.val();
        const $colorOptions = $select.siblings('.color-options');
        
        if ($colorOptions.length) {
            $colorOptions.find('.color-btn').removeClass('active');
            $colorOptions.find('.color-btn[data-value="' + value + '"]').addClass('active');
        }
    });
});