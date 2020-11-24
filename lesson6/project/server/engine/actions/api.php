<?php

    $result = '';

    if (!$req = explode('/', $_SERVER['REQUEST_URI'])[2]){
        header("Location: /");
    }

    switch($req){
        case 'products':
            $result = dbGetProducts($dbConnection);
            break;
        case 'allProducts':
            $result = dbGetAllProducts($dbConnection);
            break;
        default:
            abort(404);
    }

    //Не уверен в правильности, но, вроде, работает
    print json_encode($result);
    exit;