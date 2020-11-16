<?php
    if (!isset($_GET['id'])){
        $error = 'Ошибка обработки запроса: картинка не найдена';
        $content = view('blocks/error', ['error' => $error]);
        return require TEMPLATES . 'page.php';
    }

    if (!$img = dbGetImageById($db, $_GET['id'])){
        $error = 'Ошибка обработки запроса: картинка не найдена';
        $content = view('blocks/error', ['error' => $error]);
        return require TEMPLATES . 'page.php';
    }

    dbPopulIncById($db, $img['id']);

    $title = 'Урок 5. Просмотр';
    $content = view('blocks/image', ['img' => $img]);
    require TEMPLATES . 'page.php';

