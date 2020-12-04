<?php

    require HELPERS . 'helper.php';

    if(!function_exists('dbEscape')){
        function dbEscape($link, $val){
            return mysqli_real_escape_string($link, (string)trim(htmlspecialchars(strip_tags($val))));
        }
    }

    if (!function_exists('dbConnect')){
        function dbConnect(){
            $dbConfig = require CONFIG . 'database.php';

            if (!$link = mysqli_connect(
                        $dbConfig['host'],
                        $dbConfig['userName'],
                        $dbConfig['password'],
                        $dbConfig['dbName'])){
                //TODO Обработка ошибки подключения к базе данных
                $mess = "Ошибка подключения к базе данных: " . mysqli_connect_error();
                write_log('database', $mess);
                echo view('pages/error', ['message' => "Ошибка подключения к базе данных"]);
                exit;
            }

            return $link;

        }
    }

    if (!function_exists('dbQuery')){
        function dbQuery($link, $query){
            $resultSQL = mysqli_query($link, $query);
            if (!$resultSQL){
                $mess = "Ошибка запроса к базе данных: " . mysqli_errno($link) . mysqli_error($link);
                write_log('database', $mess);
                return;
            }


            if (is_bool($resultSQL)){
                return $resultSQL;
            }

            $result = [];
            while ($row = mysqli_fetch_assoc($resultSQL)){
                $result[] = $row;
            }

            return $result;
        }
    }


    //products

    if (!function_exists('dbGetProducts')){
        function dbGetProducts($link, $where = ['status' => 'active']){
            $whereStr = "";
            if (!$where) {
                $where = '';
            }else{
                $whereStr = " WHERE " . implode(", ", array_map(function($key, $value) use($link)
                {
                    return "$key = '" . dbEscape($link, $value) . "'";
                }, array_keys($where), $where));
            }

            $query = "SELECT * FROM `products` $whereStr;";
            return correctPathImg($link, dbQuery($link, $query));

        }
    }

    if(!function_exists('dbGetProductById')){
        function dbGetProductById($link, $id){
            $query = "SELECT * FROM `products` WHERE `id`=" . dbEscape($link, $id);
            return correctPathImg($link, dbQuery($link, $query))[0];
        }
    }

    if(!function_exists('dbGetProductsByIdAll')){
        function dbGetProductsByIdAll($link, $arr_id){

            $where = "id = " . implode(" OR id = ", $arr_id);
            $query = "SELECT * FROM `products` WHERE $where";
            return correctPathImg($link, dbQuery($link, $query));
        }
    }

    if (!function_exists('correctPathImg')){
        function correctPathImg($link, array $arr){
            $result = [];
            foreach ($arr as $key => $el){
                $result[$key] = $el;
                $result[$key]['img'] = UPLOAD_IMG . $el['img'];
                //Не знаю почему, но $el['img'] = UPLOAD_IMG . $el['img'] не работает :-(
            }
            return $result;
        }

    }

    if(!function_exists('dbCreateProduct')){
        function dbCreateProduct($link, $data){
    //            echo "INSERT INTO `products`
    //                        (`name`, `img`, `price`, `desc`, `status`)
    //                        VALUES(
    //                        '{$data['name']}',
    //                        '{$data['img']}',
    //                        '{$data['price']}',
    //                        '{$data['desc']}',
    //                        '{$data['status']}');";
    //            die;
            $clean_data = array_map(fn($value) => dbEscape($link, $value), $data);
            dbQuery($link,
                "INSERT INTO `products` 
                            (`name`, `img`, `price`, `desc`, `status`)
                            VALUES(
                            '{$clean_data['name']}',
                            '{$clean_data['img']}',
                            '{$clean_data['price']}',
                            '{$clean_data['desc']}',
                            '{$clean_data['status']}');"
            );
        }
    }

    if(!function_exists('dbDeleteProduct')){
        function dbDeleteProduct($link, $id){
            return dbQuery($link,
                "UPDATE `products` SET `status` = 'deleted' WHERE `id` = " . dbEscape($link, $id));

        }
    }

    if(!function_exists('dbUpdateProduct')){
        function dbUpdateProduct($link, $data){

            $clean_data = array_map(fn($value) => dbEscape($link, $value), $data);
            return dbQuery($link,
                "UPDATE `products` SET 
                            `name` = '{$clean_data['name']}',
                            `img`= '{$clean_data['img']}',
                            `price`={$clean_data['price']},
                            `desc`='{$clean_data['desc']}',
                            `status`='{$clean_data['status']}'
                             WHERE `id` = {$clean_data['id']};");
        }
    }

    //reviews

    if(!function_exists('dbGetReviewsByProduct')){
        function dbGetReviewsByProduct($link, $id){
            return dbQuery($link,
                "SELECT `reviews`.`id`, `reviews`.`message`, `authors`.`name` 
                        FROM `reviews`, `authors` 
                        WHERE `reviews`.`id_product`=" . dbEscape($link, $id) . " AND `reviews`.`id_auth`=`authors`.`id`");
        }
    }

    if(!function_exists('dbGetIdAuth')){
        function dbGetIdAuth($link, $auth){
            if (!$result = dbQuery($link,
                "SELECT `id` FROM `authors` WHERE `name` = '" . dbEscape($link, $auth) . "'")){
                return;
            };

            return $result[0]['id'];
        }
    }

    if(!function_exists('dbAddAuth')){
        function dbAddAuth($link, string $auth){
            if (!$result = dbQuery($link,
                "INSERT INTO `authors` (`name`) VALUES ('" . dbEscape($link, $auth) . "')"
            )){
                return;
            }

            return mysqli_insert_id($link);
        }
    }

    if(!function_exists('dbAddReview')){
        function dbAddReview($link, $id_product, $auth, $mess){

            //Получаем id автора
            if(!$idAuth = dbGetIdAuth($link, dbEscape($link, $auth))){
                $idAuth = dbAddAuth($link, dbEscape($link, $auth));
            };

            //Добавление отзыва в таблицу БД
            return dbQuery($link,
                "INSERT INTO `reviews` (`id_product`, `id_auth`, `message`) 
                            VALUES (" . dbEscape($link, $id_product) . ", $idAuth, '" .
                                    dbEscape($link, $mess) . "')");
        }
    }



    //carts

    if(!function_exists('dbGetCart')){

        function dbGetCart($link, $id_cart){

            return dbQuery($link,
                "SELECT `products`.`id`, `products`.`name`, `products`.`price`,
                              `cart`.`qty`  FROM `products`, `cart` 
                              WHERE `cart`.`id_cart` = " . dbEscape($link, $id_cart) . " AND `products`.`id` = `cart`.`id_product`;"
            );
        }
    }

    if (!function_exists('dbAddToCart')){
        function dbAddToCart($link, $id_cart, $id_product, $qty){
            $clean_id_cart = dbEscape($link, $id_cart);
            $clean_id_product = dbEscape($link, $id_product);
            $clean_qty = dbEscape($link, $qty);

            if($data = dbGetProdByIdFromCart($link, $clean_id_cart, $clean_id_product)){
                $qty_old = array_get(array_shift($data), 'qty', 0);
                if ($qty_old){
                    $qty_new = $qty_old + $qty;
                    $result =
                        dbQuery($link,
                            "UPDATE `cart` SET `qty` = $qty_new WHERE `id_cart` = $clean_id_cart AND `id_product` = $clean_id_product;"
                        );
                    return $result;
                }
            }

            $result = dbQuery($link,
                "INSERT INTO `cart` (`id_cart`, `id_product`, `qty`)
                       VALUES ($clean_id_cart, $clean_id_product, $clean_qty);"
            );

            return $result;
        }
    }

    if(!function_exists('dbGetProdByIdFromCart')){

        function dbGetProdByIdFromCart($link, $id_cart, $id_product){
            return dbQuery($link,
                "SELECT * FROM `cart` WHERE `id_cart`= " . dbEscape($link, $id_cart) . " AND `id_product` = " . dbEscape($link, $id_product));
        }
    }

    if(!function_exists('dbGetIdCart')){
        function dbGetIdCart($link){

            if ($user_id = array_get($_SESSION, 'user_id')){

                if($id = dbQuery($link,
                    "SELECT `id` FROM `carts` WHERE `user_id` = $user_id")){

                    return $id[0]['id'];
                }else{
                    return dbAddCart($link, $user_id);
                }
            }
        }
    }

    if(!function_exists('dbGetCountFromCart')){
        function dbGetCountFromCart($link, $id_cart){
            $res = dbQuery($link,
                "SELECT * FROM `cart` WHERE `id_cart` = " . dbEscape($link, $id_cart));
            return sizeof($res);
        }
    }

    if(!function_exists('dbAddCart')) {
        function dbAddCart($link, $user_id)
        {
            if (dbQuery($link,
                "INSERT INTO `carts` (`user_id`)
                         VALUES ($user_id)")) {
                return mysqli_insert_id($link);
            }
            return;
        }
    }

    if(!function_exists('dbDeleteProdFromCart')){
        function dbDeleteProdFromCart($link, $id_cart, $id_product){

            $clean_id_cart = dbEscape($link, $id_cart);
            $clean_id_product = dbEscape($link, $id_product);
            return dbQuery($link, "DELETE FROM `cart` WHERE `id_cart` = $clean_id_cart AND `id_product` = $clean_id_product;");
        }
    }

    //Учётные записи

    if(!function_exists('dbGetUserByName')){
        function dbGetUserByName($link, $name){
            $res = dbQuery($link,
              "SELECT * FROM `users` WHERE `name` = '" . dbEscape($link, $name) . "'");

            if (is_array($res)) {
                return array_shift($res);
            }
            return false;
        }
    }

    if(!function_exists('dbGetUserByEmail')){
        function dbGetUserByEmail($link, $email){
            $res = dbQuery($link,
                "SELECT * FROM `users` WHERE `email` = '" . dbEscape($link, $email) . "';");

            if (is_array($res)) {
                return array_shift($res);
            }
            return false;
        }
    }

    if(!function_exists('dbAddUser')){
        function dbAddUser($link,$data){

            $clean_data = array_map(fn($value) => dbEscape($link, $value), $data);
            return dbQuery($link,
                "INSERT INTO `users` (`name`, `email`, `password`)
                        VALUES ('{$clean_data['userName']}', '{$clean_data['email']}', '{$clean_data['password']}');"
            );
        }
    }