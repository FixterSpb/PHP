<?php
/*
 * 5. Посмотреть на встроенные функции PHP. Используя имеющийся HTML-шаблон,
 * вывести текущий год в подвале при помощи встроенных функций PHP.
 */

/*
 * Честно говоря, не совсем понял о каком HTML-шаблоне идет речь. Не думаю, что стоит сюда весь магазин вываливать.
 */

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <div class="top"></div>

    <footer><?=date('Y')?></footer>
</body>
</html>
