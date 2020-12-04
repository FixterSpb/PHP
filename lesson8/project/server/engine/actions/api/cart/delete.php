<?php


    //Не авторизованная корзина
    if(!array_get($_SESSION, 'user_id')){

        if(!array_get($_SESSION, 'cart')){
            errorJSON('Ошибка базы данных');
        }

        $cart = json_decode($_SESSION['cart'], true);
        if (count($cart) > 1){
            unset($cart[$data['id']]);
            $count = count($cart);
            $_SESSION['cart'] = json_encode($cart);

        }else{
            unset($_SESSION['cart']);
            $count = 0;
        }

        okJSON(['countCart' => $count]);
    }

    //Авторизованная корзина
    if(!$result = dbDeleteProdFromCart($dbConnection, $id_cart, $data['id'])){
        errorJSON('Ошибка базы данных');
    };

    okJSON([]);
