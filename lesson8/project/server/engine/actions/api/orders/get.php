<?php

    require HELPERS . 'json.php';

    $user_id = $_SESSION['user_id'];

    $ordersModel = loadModel('order');
    $orders = $ordersModel['getAllFromUser']($user_id);

//    var_dump($user_id);
    okJSON($orders);
