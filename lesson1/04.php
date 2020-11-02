<?php

/**
 * 4. Используя имеющийся HTML-шаблон, сделать так, чтобы главная страница генерировалась через PHP.
 * Создать блок переменных в начале страницы.
 * Сделать так, чтобы h1, title и текущий год генерировались в блоке контента из созданных переменных.
 */

    $titlePage = 'Заголовок документа';
    $titleBody = "Заголовок H1";
    $year = date('Y');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titlePage ?></title>
</head>
<body>
    <h1><?= $titleBody ?></h1>
    <p>Текущий год: <?= $year ?></p>
</body>
</html>

