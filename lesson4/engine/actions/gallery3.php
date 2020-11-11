<?php

    $title = "Урок 4. Задание № 3";
    $gallery = getImgLinks('img/');
    require TEMPLATES . 'head.php';
    require TEMPLATES . "gallery.php";
    echo "<script src='./js/main.js'></script>";
    require TEMPLATES . 'endPage.php';
