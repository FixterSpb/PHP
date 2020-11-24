<!doctype html>
<html lang="en">
<head>
    <?php require TEMPLATES . 'parts/head.php' ?>
</head>
<body>
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

    <div class="review">
        <h2>Отзывы:</h2>
        <?php foreach ($reviews as $item): ?>
            <div class="review__item">
                <h4 class="review__auth">
                    <?= $item['name'] ?>
                </h4>
                <p class="review__text">
                    <?= $item['message'] ?>
                </p>
            </div>
        <?php endforeach?>


        <form class="review__form" action="/addReview" method="post">
            <input style="display: none" name="id_product" value="<?= $product['id'] ?>">
            <label for="auth">Ваше имя:</label>
            <br>
            <input type="text" placeholder="Ваше имя" name="auth" required
                    value="<?= isset($_POST['auth']) ? isset($_POST['auth']) : '' ?>">
            <br>
            <label for="message">Сообщение:</label>
            <br>
            <textarea name="message" cols="50" rows="10"
                      placeholder="Сообщение - не более 255 символов"
                      value="<?= isset($_POST['message']) ? isset($_POST['message']) : '' ?>"
                      required></textarea>
            <br>
            <button type="submit">Отправить</button>
        </form>
    </div>
</body>
</html>
