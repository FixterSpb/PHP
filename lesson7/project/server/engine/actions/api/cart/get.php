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

    //Авторизованная корзина
    okJSON(dbGetCart($dbConnection, $id_cart));
