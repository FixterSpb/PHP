<?php
    $title = "Корзина товаров";

    $header = view('parts/header',
        [
            'menuList' => getMainMenuList('Корзина'),
            'title' => $title
        ]
    );

//    $content = view('parts/cartTable',
//        [
//            'products' =>
//                [
//                    [
//                        'name' => 'Товар № 1',
//                        'price' => 1000,
//                        'qty' => 10,
//                        'amount' => 10000,
//                        'id' => 10000
//                    ],
//                    [
//                        'name' => 'Товар № 1',
//                        'price' => 1000,
//                        'qty' => 10,
//                        'amount' => 10000,
//                        'id' => 10000
//                    ],
//                    [
//                        'name' => 'Товар № 1',
//                        'price' => 1000,
//                        'qty' => 10,
//                        'amount' => 10000,
//                        'id' => 10000
//                    ],
//                    [
//                        'name' => 'Товар № 1',
//                        'price' => 1000,
//                        'qty' => 10,
//                        'amount' => 10000,
//                        'id' => 10000
//                    ],
//                    [
//                        'name' => 'Товар № 1',
//                        'price' => 1000,
//                        'qty' => 10,
//                        'amount' => 10000,
//                        'id' => 10000
//                    ],
//                    [
//                        'name' => 'Товар № 1',
//                        'price' => 1000,
//                        'qty' => 10,
//                        'amount' => 10000,
//                        'id' => 10000
//                    ],
//                    [
//                        'name' => 'Товар № 1',
//                        'price' => 1000,
//                        'qty' => 10,
//                        'amount' => 10000,
//                        'id' => 10000
//                    ],
//                    [
//                        'name' => 'Товар № 1',
//                        'price' => 1000,
//                        'qty' => 10,
//                        'amount' => 10000,
//                        'id' => 10000
//                    ],
//
//                ]
//        ]
//    );

    $content = view('parts/cart', []);
    require PAGES . 'home.php';