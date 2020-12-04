<?php

    $orderModel['db'] = loadModel('db');

    $orderModel['insertOrder'] = function($user_id, $total = 0, $status = 'new', $comment = '') use($orderModel){
        $sql = "INSERT INTO `orders` (`user_id`, `total`, `status`, `comment`) 
                    VALUES ($user_id, $total, '$status', '$comment')";
//        var_dump($sql);
//        die;

        if(!$orderModel['db']['query']($sql)){
            return;
        };

        return $orderModel['db']['lastInsertId']();
    };

    $orderModel['insertItem'] = function(array $params) use($orderModel){

        $fields = implode(', ', array_map(fn($item) => "`$item`", array_keys($params)));
        $values = implode(', ', array_map(fn($item) => "'$item'", $params));

        $sql = "INSERT INTO `order_item` ($fields) 
                        VALUES ($values)";

        if(!$orderModel['db']['query']($sql)){
            return;
        };

        return $orderModel['db']['lastInsertId']();
    };

    $orderModel['create'] = function ($user_id) use($orderModel){
        $cart = loadModel('cart');
        $cart_id = $cart['getId']($user_id);


        $order_id = $orderModel['insertOrder']($user_id);
        $products = $cart['getAllForOrder']($cart_id);
        $amount = 0;

        foreach ($products as $value){
            $value['order_id'] = $order_id;

            $orderModel['insertItem']($value);
            $amount += $value['price'] * $value['qty'];
        }

        var_dump($amount);
        return $order_id;
    };



    //$currentModel['copyFromCart'] = function()

    return $orderModel;
