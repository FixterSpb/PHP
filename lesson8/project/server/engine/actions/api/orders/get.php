<?php

    require HELPERS . 'json.php';

    if($_SESSION['permission'] === 'admin'){
       $user_id = null;
    }else {
        $user_id = $_SESSION['user_id'];
    }

    $ordersModel = loadModel('order');
    $orders = $ordersModel['getAll']($user_id);

//    var_dump($user_id);
    okJSON($orders);
