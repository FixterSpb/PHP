<!doctype html>
<html lang="en">
<head>
    <?php require TEMPLATES . 'parts/head.php' ?>
</head>
<body>
    <header>
        <?= isset($header) ? $header : '' ?>
    </header>
    <?= isset($content) ? $content : "" ?>
</body>
</html>
