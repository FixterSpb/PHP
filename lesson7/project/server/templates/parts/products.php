<main id="app">
    <products ref="products" mode="<?= isset($mode) ? $mode : 'view' ?>"></products>
</main>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="/js/Products.js?ver=<?=date('U')?>"></script>
<script src="/js/main.js?ver=<?=date('U')?>"></script>

