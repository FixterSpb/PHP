<?php

    $validator = require ENGINE . 'validators/checkin.php';
    $post = [];
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $post = array_clean($_POST);
        if(!$errors = $validator['validate']($post)){
            $userName = array_get($post, 'userName');
            $pass = array_get($post, 'password');
            $passConfirm = array_get($post, 'confirmPassword');
            $email = array_get($post, 'email');

            $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);

            if (dbGetUserByName($dbConnection, $userName)){
                $errors['userName'] = "Этот логин занят, придумайте другой";
            }elseif($pass !== $passConfirm){
                $errors['confirmPassword'] = 'Пароли должны совпадать';
            }elseif (dbGetUserByEmail($dbConnection, $email)){
                $errors['email'] = 'Пользователь с таким E-mail уже зарегистрирован!';
            }

            if(!$errors){
                if(!dbAddUser($dbConnection, $post)){
                    $errors['other'] = 'Произошла неизвестная ошибка.';
                }
            }

            if(!$errors){
                header("Location: /login");
            }
        };
    }
    $errors['other'] = 'Произошла неизвестная ошибка.';

    $header = view('parts/header',
        [
            'menuList' => getMainMenuList('Вход'),
            'title' => 'Вход'
        ]
    );
    $content = view('forms/checkin',
        [
            'errors' => $errors,
            'data' => $post,
        ]);

    require PAGES . 'home.php';
