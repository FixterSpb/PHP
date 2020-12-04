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


    $header = view('parts/header',
        [
            'menuList' => getMainMenuList('Личный кабинет', 'user'),
            'title' => 'Личный кабинет',
        ]);

    $content = view('parts/office', []);

    require PAGES . "home.php";
