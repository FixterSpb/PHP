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

    $orderModel['updateOrder'] = function($order_id, $params) use($orderModel) {
        $sqlParams = implode(', ', array_map(fn($key, $value) => "$key = $value",
            array_keys($params), $params));
        $sql = "UPDATE `orders` SET $sqlParams WHERE `id` = $order_id";

        if(!$orderModel['db']['query']($sql)){
            return;
        }
        return true;
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

    $orderModel['create'] = function ($user_id, $comment) use($orderModel){
        $cart = loadModel('cart');
        $cart_id = $cart['getId']($user_id);


        $order_id = $orderModel['insertOrder']($user_id);
        $products = $cart['getAllForOrder']($cart_id);
        $total = 0;

        foreach ($products as $value){
            $value['order_id'] = $order_id;

            $orderModel['insertItem']($value);
            $total += $value['price'] * $value['qty'];
        }

        $orderModel['updateOrder']($order_id,
            [
                'total' => $total,
                'comment' => "'$comment'",

            ]);

        $cart['delete']($cart_id);

        return $order_id;
    };

    $orderModel['getAll'] = function ($user_id = null) use($orderModel){
        $db = $orderModel['db'];

        $sql = "SELECT `orders`.`id` as 'id', `orders`.`status`,
                        `orders`.`total`, `users`.`name` FROM `orders`
                INNER JOIN `users` ON `orders`.`user_id` = `users`.`id`";
        if ($user_id){
            $sql .= " WHERE `user_id` = $user_id";
        }

        return $db['queryAll']($sql);;

    };

    $orderModel['getOne'] = function ($order_id = null) use($orderModel){
        $db = $orderModel['db'];

        $sql = "SELECT `products`.`id`, `products`.`name`, `products`.`price`,
                        `order_item`.`price`, `order_item`.`qty` FROM `products`
                        INNER JOIN `order_item` ON `order_item`.`product_id` = `products`.`id`
                        WHERE `order_id` = $order_id";

//        vdd($sql);
        return $db['queryAll']($sql);;
    };
    $orderModel['getComment'] = function ($order_id = null) use($orderModel) {
        $db = $orderModel['db'];
        $sql = "SELECT `comment` FROM `orders` WHERE `id` = $order_id";
        return $db['queryOne']($sql)['comment'];
    };


    //$currentModel['copyFromCart'] = function()

    return $orderModel;
