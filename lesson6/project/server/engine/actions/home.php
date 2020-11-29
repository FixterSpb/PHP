<?php

    $title = 'Каталог товаров';
    $modeLink = '/editMode';
    $modeMess = "Режим редактирования";

    $header = view('parts/header',
        [
            'menuList' => getMainMenuList($title),
            'title' => 'Каталог товаров'
        ]
    );
    $content = view('parts/products',
        [
            'mode' => 'view'
        ]);

require PAGES . 'home.php';