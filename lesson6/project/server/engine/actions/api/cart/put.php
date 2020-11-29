<?php

    $id = array_get($data, 'id');
    $qty = array_get($data, 'quantity');
    if (!$product = dbGetProductById($dbConnection, $id) ||
        $product['status'] !== 'active'){
        errorJSON('Ошибка данных');
    };

    if(!$product = dbGetProdByIdFromCart($dbConnection, $id_cart, $id) ||
        !is_array($product) ||
        (array_get($product[0], 'qty', 0) - $qty) < 1){
        errorJSON('Ошибка данных');
    }

    if(!dbAddToCart($dbConnection, $id_cart, $id, $qty)){
        errorJSON('Ошибка базы данных');
    }


    if(!$result = dbGetProdByIdFromCart($dbConnection, $id_cart, $id)[0]){
        errorJSON('Ошибка базы данных');
    }

    answerJSON([$result]);