<?php
/*
 * Не обращайте внимание, этот файл для отладки
 */

//    $cart = loadModel('cart');
//    $cart_id = $cart['getId'](12);
//    var_dump($cart_id, $cart['getAll']($cart_id));

    $order = loadModel('order');
    var_dump($order['create'](12));