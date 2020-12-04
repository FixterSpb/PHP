<?php

    $product_id = array_get($data, 'id');
    $qty = array_get($data, 'quantity');


    //Не авторизованная корзина
    if(!array_get($_SESSION, 'user_id')){

        if(!array_get($_SESSION,'cart') || !$cart = json_decode($_SESSION['cart'], true)){
            $cart = [];
        };

        if(!isset($cart[$product_id])){
            $cart[$product_id] = $qty;
        }else{
            $cart[$product_id] += $qty;
        };

        $count = count($cart);

        $_SESSION['cart'] = json_encode($cart);

        okJSON(['countCart' => $count]);
    }

    //Авторизованная корзина
    if (!$product = dbGetProductById($dbConnection, $product_id) ||
        $product['status'] !== 'active'){
        errorJSON('Ошибка данных');
    };

    if(!$product = dbGetProdByIdFromCart($dbConnection, $id_cart, $product_id) ||
        !is_array($product) ||
        (array_get($product[0], 'qty', 0) - $qty) < 1){
        errorJSON('Ошибка данных');
    }

    if(!dbAddToCart($dbConnection, $id_cart, $product_id, $qty)){
        errorJSON('Ошибка базы данных');
    }


    if(!$result = dbGetCountFromCart($dbConnection, $id_cart)){
        errorJSON('Ошибка базы данных');
    }

    okJSON(['countCart' => $result]);