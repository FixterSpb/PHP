<?php

/*Больше не используется

    $result = [];


    if (!$req = explode('/', $_SERVER['REQUEST_URI'])[2]){
        vdd($_SERVER);
        header("Location: /");
    }

    switch($req){
        case 'products':
            $result = dbGetProducts($dbConnection);
            break;
        case 'allProducts':
            $result = dbGetProducts($dbConnection, []);
            break;
        default:
            abort(404);
    }

//vdd(json_encode($result));

    //Не уверен в правильности, но, вроде, работает
    echo json_encode($result);
    exit;