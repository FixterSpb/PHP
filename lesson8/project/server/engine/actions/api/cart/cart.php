<?php

    require HELPERS . 'json.php';

    $id_cart = dbGetIdCart($dbConnection);


    switch ($_SERVER['REQUEST_METHOD']){
        case 'PUT':
            $data = getDataJson();
            require 'put.php';
            break;
        case 'GET':

            require 'get.php';
            break;
        case 'DELETE':
            $data = getDataJson();
            require 'delete.php';
            break;
        default:
            errorJSON('Ошибка метода запроса: ' . $_SERVER['REQUEST_METHOD']);
    }