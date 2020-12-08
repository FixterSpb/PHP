<?php



    $user_id = $_SESSION['user_id'];

    $order = loadModel('order');
    $order_id = $order['create']($user_id, getDataJson()['comment']);

    okJSON(['order_id' => $order_id]);
