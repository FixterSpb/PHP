<?php

//    var_dump($_SESSION);
    //Не авторизованная корзина
    if(!array_get($_SESSION, 'user_id')){

        if(!array_get($_SESSION, 'cart')){
            okJSON([]);
        }

        $qtys = json_decode($_SESSION['cart'], true);

        $cart = dbGetProductsByIdAll($dbConnection, array_keys($qtys));

        foreach ($cart as $key => $value){
            $cart[$key]['qty'] = $qtys[$value['id']];
        }

        okJSON($cart);
    }

    //Пользователь авторизовался, но у него есть неавторизованная корзина
    // выполняем слияние

    if(array_get($_SESSION, 'cart')){
        //Существует невторизованная корзина
        if ($cart = json_decode($_SESSION['cart'], true)){
            foreach ($cart as $key => $item) {
                dbAddToCart($dbConnection, $id_cart, $key, $item);
            }
        }

        unset($_SESSION['cart']);
    }

    //Авторизованная корзина
    okJSON(dbGetCart($dbConnection, $id_cart));
