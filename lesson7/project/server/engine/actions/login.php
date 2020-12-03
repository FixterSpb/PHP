<?php

    $post = [];
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = require ENGINE . 'validators/login.php';
        $post = array_clean($_POST);
        if (!$errors = $validator['validate']($post)){
            $user = dbGetUserByName($dbConnection, $post['userName']);
            if(!password_verify($post['password'], $user['password'])){
                $errors['auth'] = "Неверная пара Логин - Пароль!";
            }else{
                header("Location: /office");
            }
        }
    }
    $header = view('parts/header',
        [
            'menuList' => getMainMenuList('Вход'),
            'title' => 'Вход'
        ]
    );
    $content = view('forms/login',
        [
            'data' => $post,
            'errors' => $errors,
        ]);

    require PAGES . 'home.php';