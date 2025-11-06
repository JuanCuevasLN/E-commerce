jQuery(function($) {
    const targetNode = document.querySelector('.woocommerce-product-gallery');
    if (!targetNode) return;

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
            })
        })
    })

    observer.observe(targetNode, { childList: true, subtree: true })
})