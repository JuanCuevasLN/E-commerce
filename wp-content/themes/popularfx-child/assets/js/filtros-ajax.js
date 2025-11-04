jQuery(document).ready(function($) {
    $('#id-button-filtros').on('click', function() {
        const button = $(this);
        const loader = $('.filter-loading');
        const mainContent = $('.section-product');

        loader.show();
        button.prop('disabled', true);

        // Aquí tomas los valores de tus filtros (ajústalo a tus inputs reales)
        const filtros = {
            precio_min: $('#precio_min').val(),
            precio_max: $('#precio_max').val(),
            valoracion: $('input[name="valoracion"]:checked').val(),
            categorias: $('input[name="categoria[]"]:checked')
                .map(function() { return $(this).val(); })
                .get()
        };

        $.ajax({
            url: wp_vars.ajax_url, // lo pasamos desde PHP
            type: 'POST',
            data: {
                action: 'filtrar_productos',
                filtros: filtros
            },
            success: function(response) {
                console.log("Aqui estoy llegando 2", response)
                console.log(response.data)
                mainContent.html(response.data);
            },
            error: function(xhr, status, error) {
                console.error('Error al filtrar productos:', error);
                mainContent.html('Ocurrió un error al cargar los productos.');
            },
            complete: function() {
                loader.hide();
                button.prop('disabled', false);
            }
        });
    });
});
