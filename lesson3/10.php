<?php

    echo '<b>explode:</b><br>';
    $str = "Ноутбук, Монитор, Мышь, Клавиатура";
    $arrStr = explode(",", $str);
    echo "<pre>";
    print_r($arrStr);
    echo "</pre>";
    echo '<b>implode:</b><br>';
    echo (implode(";", $arrStr));

    echo "<br>";

    //Честно говоря, мало представляю, чем эта информация
    // может пригодиться на удаленном сервере
    echo '<b>Переменные окружения:</b><br>';
    echo "<pre>";
    print_r(getenv());
    print_r($_SERVER);
    print_r($_ENV); //Выводит пустой массив что на домашнем компьютере, что на удаленном сервере
    echo "</pre>";

    //В общем, с $_ENV, видимо, я так и не разобрался...