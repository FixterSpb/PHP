<h1 class="prodTitle"><?= $product['name']?></h1>
<div class="prodItem">
    <img class="prodItem__img" src="<?= $product['img'] ?>" alt="">
    <div class="prodItem__box">
        <p class="prodItem__price"><?= $product['price'] ?> руб.</p>
        <button class="prodItem__btn">Купить</button>
    </div>
</div>

<div class="prodDesc">
    <h2>Описание <?= $product['name']?></h2>
    <p class="prodDesc__text"><?= $product['desc'] ?></p>
</div>
