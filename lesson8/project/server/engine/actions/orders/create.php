<?php

    if(!array_get($_SESSION, 'user_id')){
        $_SESSION['error'] = 'Для оформления заказа необходимо авторизоваться';
        header('Location: /login');
    }
    $header = view('parts/header',
    [
        'menuList'  => getMainMenuList(),
        'title' => 'Оформление заказа'
    ]);

    $content = view('parts/orders/create', []);

    require PAGES . 'home.php';
