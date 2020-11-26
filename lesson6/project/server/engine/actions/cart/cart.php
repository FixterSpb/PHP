<?php
    $title = "Корзина товаров";

    $header = view('parts/header',
        [
            'menuList' => getMainMenuList('Корзина'),
            'title' => 'Каталог товаров'
        ]
    );

    $content = view('parts/cartTable',
        [
            'products' =>
                [
                    [
                        'name' => 'Товар № 1',
                        'price' => 1000,
                        'qty' => 10,
                        'amount' => 10000,
                        'id' => 10000
                    ],
                    [
                        'name' => 'Товар № 1',
                        'price' => 1000,
                        'qty' => 10,
                        'amount' => 10000,
                        'id' => 10000
                    ],
                    [
                        'name' => 'Товар № 1',
                        'price' => 1000,
                        'qty' => 10,
                        'amount' => 10000,
                        'id' => 10000
                    ],
                    [
                        'name' => 'Товар № 1',
                        'price' => 1000,
                        'qty' => 10,
                        'amount' => 10000,
                        'id' => 10000
                    ],
                    [
                        'name' => 'Товар № 1',
                        'price' => 1000,
                        'qty' => 10,
                        'amount' => 10000,
                        'id' => 10000
                    ],
                    [
                        'name' => 'Товар № 1',
                        'price' => 1000,
                        'qty' => 10,
                        'amount' => 10000,
                        'id' => 10000
                    ],
                    [
                        'name' => 'Товар № 1',
                        'price' => 1000,
                        'qty' => 10,
                        'amount' => 10000,
                        'id' => 10000
                    ],
                    [
                        'name' => 'Товар № 1',
                        'price' => 1000,
                        'qty' => 10,
                        'amount' => 10000,
                        'id' => 10000
                    ],

                ]
        ]
    );

    require PAGES . 'home.php';