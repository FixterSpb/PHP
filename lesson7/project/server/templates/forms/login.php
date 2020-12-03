
    <form class="login__form" method="post">
        <?php if (isset($errors['permission'])): ?>
            <h3 class="login__error"><?= $errors['permission'] ?></h3>
        <?php endif ?>
        <?php if(isset($errors['auth'])): ?>
            <h3 class="login__error"><?= $errors['auth'] ?></h3>
        <?php endif; ?>
        <label for="userName" class="login__label">Имя:</label>
        <br>
        <input type="text" name="userName" placeholder="Имя" class="login__input"
               value="<?= isset($data['userName']) ? $data['userName'] : '' ?>">
        <?php if(isset($errors['userName'])): ?>
            <span class="login__error"><?= $errors['userName'] ?></span>
            <br>
        <?php else: ?>
            <br>
            <br>
        <?php endif; ?>
        <br>
        <label for="password" class="login__label">Пароль:</label>
        <br>
        <input type="password" name="password" class="login__input" placeholder="Пароль">
        <?php if(isset($errors['password'])): ?>
            <span class="login__error"><?= $errors['password'] ?></span>
            <br>
        <?php else: ?>
            <br>
            <br>
        <?php endif; ?>
        <br>
        <button class="login__submit">Войти</button>
        <a href="/checkin" class="login__checkin">Зарегистрироваться</a>

    </form>
