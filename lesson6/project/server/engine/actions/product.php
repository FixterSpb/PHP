<?php

    $title = 'Продукт';

    if (!$_GET['id'] || !is_numeric($_GET['id'])){
        abort(404);
    }

    if (!$product = dbGetProductById($dbConnection, $_GET['id'])){
        abort(404);
    };

    $reviews = dbGetReviewsByProduct($dbConnection, $_GET['id']);

    require PAGES . 'product.php';
