<?php

    require HELPERS . 'helper.php';

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

    if (!function_exists('dbGetProducts')){
        function dbGetProducts($link, $where = ['status' => 'active']){
            $whereStr = "";
            if (!$where){
                $where = '';
            }else{
                $whereStr = " WHERE " . implode(", ", array_map(function($key, $value)
                {
                    return "$key = '$value'";
                }, array_keys($where), $where));
            }

            $query = "SELECT * FROM `products` $whereStr;";
            return correctPathImg($link, dbQuery($link, $query));

        }
    }
/*
    Больше не используется!
    if (!function_exists('dbGetAllProducts')){
        function dbGetAllProducts($link){
            $query = "SELECT * FROM `products`;";
            return correctPathImg($link, dbQuery($link, $query));

        }
    }
*/
    if(!function_exists('dbGetProductById')){
        function dbGetProductById($link, $id){
            $query = "SELECT * FROM `products` WHERE `id`=$id";
            return correctPathImg($link, dbQuery($link, $query))[0];
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

    if(!function_exists('dbGetReviewsByProduct')){
        function dbGetReviewsByProduct($link, $id){
            return dbQuery($link,
                "SELECT `reviews`.`id`, `reviews`.`message`, `authors`.`name` 
                        FROM `reviews`, `authors` 
                        WHERE `reviews`.`id_product`=$id AND `reviews`.`id_auth`=`authors`.`id`");
        }
    }

    if(!function_exists('dbGetIdAuth')){
        function dbGetIdAuth($link, $auth){
            if (!$result = dbQuery($link,
                "SELECT `id` FROM `authors` WHERE `name` = '$auth'")){
                return;
            };

            return $result[0]['id'];
        }
    }

    if(!function_exists('dbAddAuth')){
        function dbAddAuth($link, string $auth){
            if (!$result = dbQuery($link,
                "INSERT INTO `authors` (`name`) VALUES ('$auth')"
            )){
                return;
            }

            return mysqli_insert_id($link);
        }
    }

    if(!function_exists('dbAddReview')){
        function dbAddReview($link, $id_product, $auth, $mess){

            //Получаем id автора
            if(!$idAuth = dbGetIdAuth($link, $auth)){
                $idAuth = dbAddAuth($link, $auth);
            };

            //Добавление отзыва в таблицу БД
            return dbQuery($link,
                "INSERT INTO `reviews` (`id_product`, `id_auth`, `message`) 
                            VALUES ($id_product, $idAuth, '$mess');");
        }
    }

    if(!function_exists('dbEscape')){
        function dbEscape($link, $val){
            return mysqli_real_escape_string($link, (string)trim(htmlspecialchars(strip_tags($val))));
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
            dbQuery($link,
                "INSERT INTO `products` 
                        (`name`, `img`, `price`, `desc`, `status`)
                        VALUES(
                        '{$data['name']}',
                        '{$data['img']}',
                        '{$data['price']}',
                        '{$data['desc']}',
                        '{$data['status']}');"
            );
        }
    }

    if(!function_exists('dbDeleteProduct')){
        function dbDeleteProduct($link, $id){
            return dbQuery($link,
                    "UPDATE `products` SET `status` = 'deleted' WHERE `id` = $id");

        }
    }

    if(!function_exists('dbUpdateProduct')){
        function dbUpdateProduct($link, $data){
            return dbQuery($link,
                "UPDATE `products` SET 
                        `name` = '{$data['name']}',
                        `img`= '{$data['img']}',
                        `price`={$data['price']},
                        `desc`='{$data['desc']}',
                        `status`='{$data['status']}'
                         WHERE `id` = {$data['id']};");
        }
    }

    //Работа с корзиной

    if(!function_exists('dbGetCart')){

        function dbGetCart($link, $id_cart){
//            var_dump("SELECT `products`.`id`, `products`.`name`, `products`.`price`,
//                              `cart`.`qty`  FROM `products`, `cart`
//                              WHERE `cart`.`id_cart` = $id_cart AND `products`.`id` = `cart`.`id_product`;");
            return dbQuery($link,
                "SELECT `products`.`id`, `products`.`name`, `products`.`price`,
                              `cart`.`qty`  FROM `products`, `cart` 
                              WHERE `cart`.`id_cart` = $id_cart AND `products`.`id` = `cart`.`id_product`;"
            );
        }
    }


    if (!function_exists('dbAddToCart')){
        function dbAddToCart($link, $id_cart, $id_product, $qty){
            if($data = dbGetProdByIdFromCart($link, $id_cart, $id_product)){
                $qty_old = array_get(array_shift($data), 'qty', 0);
                if ($qty_old){
                    $qty_new = $qty_old + $qty;
                    $result =
                        dbQuery($link,
                            "UPDATE `cart` SET `qty` = $qty_new WHERE `id_cart` = $id_cart AND `id_product` = $id_product;"
                        );
                    return $result;
                }
            }

            $result = dbQuery($link,
                "INSERT INTO `cart` (`id_cart`, `id_product`, `qty`)
                       VALUES ($id_cart, $id_product, $qty);"
            );

            return $result;
        }
    }

    if(!function_exists('dbGetCart')){
        function dbGetCart($link, $id){
            return dbQuery($link,
                "SELECT * FROM `cart` WHERE `id`=$id;"
            );
        }
    }

    if(!function_exists('dbGetProdByIdFromCart')){
        function dbGetProdByIdFromCart($link, $id_cart, $id_product){
            return dbQuery($link,
                "SELECT * FROM `cart` WHERE `id_cart`= $id_cart AND `id_product` = $id_product;");
        }
    }

    if(!function_exists('dbGetIdCart')){
        function dbGetIdCart($link, $hash){
            if(!$id = dbQuery($link,
                "SELECT `id` FROM `carts` WHERE `hash_cart` = '$hash';"
            )){
                return dbAddCart($link, $hash);
            }
            return $id[0]['id'];
        }
    }

    if(!function_exists('dbAddCart')) {
        function dbAddCart($link, $hash_cart)
        {
            if (dbQuery($link,
                "INSERT INTO `carts` (`hash_cart`) VALUES ('$hash_cart');"
            )) {
                return mysqli_insert_id($link);
            }
            return;
        }
    }

    if(!function_exists('dbDeleteProdFromCart')){
        function dbDeleteProdFromCart($link, $id_cart, $id_product){
//            echo "id cart: ", $id_cart, ' id product: ', $id_product, "\n<br>";
            return dbQuery($link, "DELETE FROM `cart` WHERE `id_cart` = $id_cart AND `id_product` = $id_product;");
        }
    }

    //Учётные записи

    if(!function_exists('dbGetUserByName')){
        function dbGetUserByName($link, $name){
            $res = dbQuery($link,
              "SELECT * FROM `users` WHERE `name` = '$name';"
            );
            if (is_array($res)) {
                return array_shift($res);
            }
            return false;
        }
    }

    if(!function_exists('dbGetUserByEmail')){
        function dbGetUserByEmail($link, $email){
            $res = dbQuery($link,
                "SELECT * FROM `users` WHERE `email` = '$email';"
            );

            if (is_array($res)) {
                return array_shift($res);
            }
            return false;
        }
    }
    if(!function_exists('dbAddUserdbAddUser')){
        function dbAddUser($link,$data){
            return dbQuery($link,
                "INSERT INTO `users` (`name`, `email`, `password`)
                        VALUES ('{$data['userName']}', '{$data['email']}', '{$data['password']}');"
            );
        }
    }