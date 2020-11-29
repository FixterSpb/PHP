<?php
    $title = 'Редактирование товаров';

    $link = '/edit/?action=create';
    $messLink = 'Добавить товар';

    $header = view('parts/header',
        [
            'menuList' => getMainMenuList('Редактирование'),
            'title' => $title
        ]
    );

    $content =
        view('parts/link',
            [
                'link' => $link,
                'messLink' => $messLink
            ]) .
        view('parts/products',
        [
            'mode' => 'edit'
        ]);



    require PAGES . 'home.php';
