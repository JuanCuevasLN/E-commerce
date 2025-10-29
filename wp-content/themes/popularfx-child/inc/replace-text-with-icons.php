<?php

    add_filter('nav_menu_item_title', 'replaceTextWithIcons', 10, 4);
    function replaceTextWithIcons($title, $item, $args, $depth) {

        //Iconos menu secundario
        if ($args->theme_location === 'menu_secundario') {
            $iconos = array(
                'Favoritos' => '<i class="fa-solid fa-heart"></i>',
                'Carrito' => '<i class="fa-solid fa-cart-shopping"></i>',
                'Mi cuenta' => '<i class="fa-solid fa-user-circle"></i>',
            );
        } else {
            return $title;
        }

        if (isset($iconos[$title])) {
            return $iconos[$title];
        }


        return $title;
    }

?>