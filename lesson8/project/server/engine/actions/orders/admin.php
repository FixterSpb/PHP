<?php

if(!array_get($_SESSION, 'user_id')){
    $_SESSION['error'] = 'Для оформления заказа необходимо авторизоваться';
    header('Location: /login');
}
$header = view('parts/header',
    [
        'menuList'  => getMainMenuList('Заказы', 'admin'),
        'title' => 'Администрирование заказов'
    ]);

$content = view('parts/orders/browse', ['action' => 'admin']);

require PAGES . 'home.php';