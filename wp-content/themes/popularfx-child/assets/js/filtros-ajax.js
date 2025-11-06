function actualizarProductos() {
    console.log('Se esta organizando???');
    const loader = $('.filter-loading');
    const button = $('#id-button-filtros');
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
            .get(),
        ordenar: $('#ordenar').val()
    };

    $.ajax({
        url: wp_vars.ajax_url,
        type: 'POST',
        data: {
            action: 'filtrar_productos',
            filtros: filtros,
        },
        success: function(response) {
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
    })
}

$('#id-button-filtros').on('click', actualizarProductos);
$('#ordenar').on('change', actualizarProductos);