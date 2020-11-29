
<form class="checkin__form" method="post">
    <?php if($errors['other']): ?>
        <h3 class="checkin__error"><?= $errors['other'] ?></h3>
        <br>
    <?php endif; ?>
    <label for="userName" class="checkin__input">Имя:</label>
    <br>
    <input type="text" name="userName" placeholder="Имя" class="checkin__input"
        value="<?=isset($data['userName']) ? $data['userName'] : '' ?>">
    <?php if(isset($errors['userName'])): ?>
        <p class="checkin__error"><?= $errors['userName'] ?></p>
    <?php else: ?>
        <br>
        <br>
    <?php endif; ?>
    <br>

    <label for="password" class="checkin__label">Пароль:</label>
    <br>
    <input type="password" name="password" class="checkin__input" placeholder="Пароль">
    <?php if(isset($errors['password'])): ?>
        <p class="checkin__error"><?= $errors['password'] ?></p>
    <?php else: ?>
        <br>
        <br>
    <?php endif; ?>
    <br>

    <label for="confirmPassword" class="checkin__label">Повторите пароль:</label>
    <br>
    <input type="password" name="confirmPassword" class="checkin__input" placeholder="Повторить пароль">
    <?php if(isset($errors['confirmPassword'])): ?>
        <p class="checkin__error"><?= $errors['confirmPassword'] ?></p>
    <?php else: ?>
        <br>
        <br>
    <?php endif; ?>
    <br>

    <label for="email" class="checkin__label">E-mail:</label>
    <br>
    <input type="email" name="email" class="checkin__input" placeholder="E-mail"
           value="<?=isset($data['email']) ? $data['email'] : '' ?>">
    <?php if(isset($errors['email'])): ?>
        <p class="checkin__error"><?= $errors['email'] ?></p>
    <?php else: ?>
        <br>
        <br>
    <?php endif; ?>
    <br>
    <button class="checkin__submit">Зарегистрироваться</button>
</form>
