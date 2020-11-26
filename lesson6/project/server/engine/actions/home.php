<?php

    $title = 'Каталог товаров';
    $modeLink = '/editMode';
    $modeMess = "Режим редактирования";


    $content =
        view('parts/header',
        [
            'title' => $title,
            'modeLink' => $modeLink,
            'modeMess' => $modeMess
        ]) .
        view('parts/products', []);

    require PAGES . 'home.php';
