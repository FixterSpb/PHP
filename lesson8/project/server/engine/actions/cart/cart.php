<?php
    $title = "Корзина товаров";

    $header = view('parts/header',
        [
            'menuList' => getMainMenuList('Корзина'),
            'title' => $title
        ]
    );

    $content = view('parts/cart', []);
    require PAGES . 'home.php';