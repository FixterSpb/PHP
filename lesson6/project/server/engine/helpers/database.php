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
        function dbGetProducts($link, $status = 'active'){
            $query = "SELECT * FROM `products` WHERE `status` = '$status';";
            return correctSrcImg(dbQuery($link, $query));

        }
    }

    if (!function_exists('dbGetAllProducts')){
        function dbGetAllProducts($link){
            $query = "SELECT * FROM `products`;";
            return correctSrcImg(dbQuery($link, $query));

        }
    }

    if(!function_exists('dbGetProductById')){
        function dbGetProductById($link, $id){
            $query = "SELECT * FROM `products` WHERE `id`=$id";
            return correctSrcImg(dbQuery($link, $query))[0];
        }
    }

    if (!function_exists('correctSrcImg')){
        function correctSrcImg(array $arr){
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
                        `img`= '{$data['img']}',
                        `price`={$data['price']},
                        `desc`='{$data['desc']}',
                        `status`='{$data['status']}'
                         WHERE `id` = {$data['id']};");
        }
    }