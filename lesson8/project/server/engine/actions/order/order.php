<?php

if(!array_get($_SESSION, 'permission')){
    $_SESSION['error'] = "Для доступа в личный кабинет необходимо авторизоваться";
    header('Location: /login');
    exit;
}

if(!array_get($_SESSION, 'user_name') || !array_get($_SESSION, 'user_id'))
{
    $_SESSION['error'] = "Для доступа в личный кабинет необходимо авторизоваться";
    header('Location: /login');
    exit;
}

//$id = array_get($_GET, 'id');
//$menuTitle = $id ? '':
$header = view('parts/header',
    [
        'menuList' => getMainMenuList("Заказ № {$_GET['id']}" , 'user'),
        'title' => "Заказ № {$_GET['id']}",
    ]);

$content = view('parts/orders/orderItem', ['id' => $_GET['id']]);

require PAGES . "home.php";
