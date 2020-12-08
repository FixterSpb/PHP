<?php

    $cartModel['db'] = loadModel('db');

    $cartModel['getId'] = function($user_id) use($cartModel){
        $sql = "SELECT `id` FROM `carts` WHERE `user_id` = $user_id";

        return  $cartModel['db']['queryOne']($sql)['id'];
    };

    $cartModel['getAll'] = function($cart_id) use($cartModel){


        $sql = "SELECT `products`.`id`, `products`.`name`, `products`.`price`, `cart`.`qty`, `products`.`price` * `cart`.`qty` as `amount` FROM `products`
                    INNER JOIN `cart` ON `products`.`id` = `cart`.`id_product`
                    WHERE `cart`.`id_cart` = $cart_id";
        return $cartModel['db']['queryAll']($sql);
    };

    $cartModel['getAllForOrder'] = function($cart_id) use($cartModel){


        $sql = "SELECT `products`.`id` as `product_id`, `products`.`price` as `price`, `cart`.`qty` as `qty` FROM `products`
                        INNER JOIN `cart` ON `products`.`id` = `cart`.`id_product`
                        WHERE `cart`.`id_cart` = $cart_id";
        return $cartModel['db']['queryAll']($sql);
    };

    $cartModel['delete'] = function($cart_id) use($cartModel){
        $db = $cartModel['db'];

        $db['query']("DELETE FROM `cart` WHERE `id_cart` = $cart_id");
        $db['query']("DELETE FROM `carts` WHERE `id` = $cart_id");
    };

//    $currentModel

    return $cartModel;
