<?php

    if(!isset($_POST['id_product']) ||
        !is_numeric($_POST['id_product']) ||
        !isset($_POST['auth']) ||
        !isset($_POST['message'])){
        //Обязательность заполнения полей отзыва котролируется на уровне верстки,
        //если пришли сюда без соответствующих полей в POST, значит это было сделано намеренно,
        //просто делаем редирект

        header("Location: {$_SERVER['HTTP_REFERER']}");
        die;
    }

    $id_product = $_POST['id_product'];
    $mess = htmlspecialchars(strip_tags($_POST['message']));
    $auth = htmlspecialchars(strip_tags($_POST['auth']));

    if(!dbGetProductById($dbConnection, $id_product)){
        abort(404);
    }

    dbAddReview($dbConnection, $id_product, $auth, $mess);
    header("Location: {$_SERVER['HTTP_REFERER']}");