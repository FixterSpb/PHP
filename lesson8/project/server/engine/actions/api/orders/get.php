<?php

    require HELPERS . 'json.php';

    $user_id = $_SESSION['user_id'];

    $cart = loadModel('cart');
    $cart_id = $cart['getId']($user_id);
    if(!$products = $cart['getAll']($cart_id)){
        abort(404);
    }

    okJSON((array)$products);
