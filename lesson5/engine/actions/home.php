<?php
    $title = "Урок 5. Галерея";
    if (!$gallery = dbGetGallery($db)){
        $error = 'Ошибка базы данных. Не удалось загрузить галерею';
        $content = view('blocks/error', ['error' => $error]);
        return require TEMPLATES . 'page.php';
    }
    $content = view('blocks/gallery', ['gallery' => $gallery]);
    require TEMPLATES . 'page.php';