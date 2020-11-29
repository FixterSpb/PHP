<?php

    $title = 'Продукт';
    $modeLink = '/';
    $modeMess = "Главная";

    if (!array_get($_GET, 'id') || !is_numeric($_GET['id'])){
        abort(404);
    }

    if (!$product = dbGetProductById($dbConnection, $_GET['id'])){
        abort(404);
    };

    $reviews = dbGetReviewsByProduct($dbConnection, $_GET['id']);

    $header = view('parts/header',
        [
            'menuList' => getMainMenuList(''),
            'title' => $product['name'],
        ]
    );

    $content =
        view('parts/product',
        [
            'title' => $title,
            'product' => $product,
        ]) . view('parts/reviews',
        [
            'product' => $product,
            'reviews' => $reviews
        ]);

    require PAGES . 'home.php';
