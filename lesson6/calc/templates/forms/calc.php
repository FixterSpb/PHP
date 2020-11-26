<form action="<?= $action ?>" >
    <div style="display: flex; flex-wrap: wrap">
    <div>
        <input type="number" name="num1" required value="<?= isset($num1) ? $num1 : ''?>" onkeydown="return inputValidate(this, event)">
        <?php if (isset($errors['num1'])): ?>
            <p style="color: indianred; margin: 0; padding: 0; max-width: 150px"><?= $errors['num1'] ?></p>
        <?php endif; ?>
    </div>
    <div>
        <select name="math_act" required>
            <option value="+" <?= $math_act === '+' ? 'selected' : '' ?>>+</option>
            <option value="-" <?= $math_act === '-' ? 'selected' : '' ?>>-</option>
            <option value="/" <?= $math_act === '/' ? 'selected' : '' ?>>/</option>
            <option value="x" <?= $math_act === 'x' ? 'selected' : '' ?>>x</option>
        </select>
    </div>
    <div>
        <input type="number" name="num2" required value="<?= isset($num2) ? $num2 : ''?>" onkeydown="return inputValidate(this, event)">
        <?php if (isset($errors['num2'])): ?>
            <p style="color: indianred; margin: 0; padding: 0; max-width: 150px"><?= $errors['num2'] ?></p>
        <?php endif; ?>
    </div>
    <?php if (isset($result)): ?>
        <span style="margin-left: 5px;"> = <?= $result ?></span>
    <?php endif; ?>
    </div>
    <button type="submit">Вычислить</button>
</form>
