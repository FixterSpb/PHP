<!doctype html>
<html lang="en">
<head>
    <?php require TEMPLATES . 'parts/head.php' ?>
</head>
<body>
<div class="container" id="app">
    <header>
        <?= isset($header) ? $header : '' ?>
    </header>


    <?= isset($content) ? $content : "" ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="/js/CartCounter.js?ver=<?=date('U')?>"></script>
<script src="/js/main.js?ver=<?=date('U')?>"></script>
<script src="/js/showImg.js?ver=1.002"></script>

</body>
</html>
