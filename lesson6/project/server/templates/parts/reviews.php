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
