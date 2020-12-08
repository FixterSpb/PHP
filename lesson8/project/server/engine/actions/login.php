<?php

    $post = [];
    $errors = [];
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $validator = require ENGINE . 'validators/login.php';
        $post = array_clean($_POST);
        if (!$errors = $validator['validate']($post)){
            if(!$user = dbGetUserByName($dbConnection, $post['userName'])){
                $errors['auth'] = "Неверная пара Логин - Пароль!";

            }elseif(!password_verify($post['password'], $user['password'])){
                $errors['auth'] = "Неверная пара Логин - Пароль!";
            }else{
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['permission'] = $user['permission'];
                header("Location: /office");
            }
        }
    }

    if(array_get($_SESSION, 'error')){
        $errors['permission'] = $_SESSION['error'];
        unset($_SESSION['error']);
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