<?php

    require HELPERS . 'json.php';
    $arr = explode("?", $_SERVER['HTTP_REFERER']);
    $id = array_unshift($arr);

//    var_dump($_GET);

    $order = loadModel('order');

    $result = $order['getOne']($_GET['id']);
    $comment = $order['getComment']($_GET['id']);
    $result['comment'] = $comment;

    okJSON($result);
