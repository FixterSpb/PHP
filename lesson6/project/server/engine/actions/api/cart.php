<?php

    require HELPERS . 'json.php';

    $hash_cart = array_get($_COOKIE, 'hash_cart');
    $id_cart = dbGetIdCart($dbConnection, $hash_cart);

    function getData()
    {
        $validator = require ENGINE . 'validators/json.php';
        $stream = fopen('php://input', 'r');
        if (!$jData = fread($stream, 1024)) {
            write_log('cart_json', "Ошибка передачи данных");
            errorJSON('Ошибка передачи данных 1');
        }
        fclose($stream);


        if (!$data = json_decode($jData, true)) {
            write_log('cart_json', "Ошибка передачи данных");
            errorJSON('Ошибка передачи данных');
        };


        if ($errors = $validator[$_SERVER['REQUEST_METHOD']]($data)) {
            array_log('cart_json', $errors);
            errorJSON(array_toString($errors));
        }

        return $data;
    }
    switch ($_SERVER['REQUEST_METHOD']){
        case 'PUT':
            $data = getData();
            require 'cart/put.php';
            break;
        case 'GET':
            okJSON(dbGetCart($dbConnection, $id_cart));
            break;
        case 'DELETE':
            $data = getData();
            require 'cart/delete.php';
            break;
        default:
            answerJSON([$_SERVER['REQUEST_METHOD']]);
    }