<?php

    $title = 'Продукт';
    $modeLink = '/';
    $modeMess = "Главная";

    if (!$_GET['id'] || !is_numeric($_GET['id'])){
        abort(404);
    }

    if (!$product = dbGetProductById($dbConnection, $_GET['id'])){
        abort(404);
    };

    $reviews = dbGetReviewsByProduct($dbConnection, $_GET['id']);

    $content =
        view('parts/header',
        [
            'modeLink' => $modeLink,
            'modeMess' => $modeMess,
            'title' => $title,
        ]) .
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
