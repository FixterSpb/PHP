<?php

    $db_name = 'phpdb';
    $db_user = 'root';
    $db_pass = '';

    define ('DB_IMAGES_TABLE', 'images');

    $db = mysqli_connect('localhost', $db_user, $db_pass, $db_name);
    if (!$db) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL . "<br>";
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL . "<br>";
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL . "<br>";
        exit;
    }