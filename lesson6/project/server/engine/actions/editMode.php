<?php
    $title = 'Редактирование товаров';
    $modeLink = '/';
    $modeMess = "Выйти из режима редактирования";

    $link = '/edit/?action=create';
    $messLink = 'Добавить товар';

    $content = view('parts/header',
            [
                'title' => $title,
                'modeLink' => $modeLink,
                'modeMess' => $modeMess
            ]) .
        view('parts/link',
            [
                'link' => $link,
                'messLink' => $messLink
            ]) .
        view('parts/editProducts', []);



    require PAGES . 'home.php';
