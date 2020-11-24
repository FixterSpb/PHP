<?php $title = 'Ошибка'?>
<!doctype html>
<html lang="en">
<head>
    <?php require TEMPLATES . 'parts/head.php' ?>
</head>
<body>
    <h1><?= isset($message) ? $message : "Произошла неизвестная ошибка"?></h1>
</body>
</html>
