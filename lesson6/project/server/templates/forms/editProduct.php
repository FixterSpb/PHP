<?php //var_dump($post) ?>
<form enctype="multipart/form-data" method="post">
    <?php if(isset($action)): ?>
        <input style="display: none" name="action" value="<?= $action ?>">
    <?php endif; ?>
    <?php if(isset($id)): ?>
        <input style="display: none" name="id" value="<?= $id ?>">
    <?php endif; ?>
    <label for="name">Название:</label>
    <br>
    <input type="text" name="name" placeholder="Название товара"
           value="<?= isset($post['name']) ? $post['name'] : ''?>" required>
    <?php if (isset($errors['name'])): ?>
        <?php foreach ($errors['name'] as $el): ?>
            <i style="color: indianred"><?= $el ?></i>
        <?php endforeach; ?>
    <?php endif; ?>
    <br>

    <label for="img">Картинка:</label>
    <br>
        <img id="uploadImage" src="<?= isset($post['img']) ? $post['img'] : '#' ?>" alt="">
    <br>
    <input type="file" name="img" value="<?= isset($post['img']) ? $post['img'] : '#' ?>">
    <br>

    <label for="price">Цена:</label>
    <br>
    <input type="text" name="price" placeholder="0.00"
           value="<?= isset($post['price']) ? $post['price'] : ''?>"
            pattern="^\d+\.?\d{0,2}$" required>
    <?php if (isset($errors['price'])): ?>
        <?php foreach ($errors['price'] as $el): ?>
            <i style="color: indianred"><?= $el ?></i>
        <?php endforeach; ?>
    <?php endif; ?>
    <br>

    <label for="desc">Описание:</label>
    <br>
    <textarea name="desc" rows="10" cols="50" placeholder="Описание товара" required
        ><?= isset($post['desc']) ? $post['desc'] : ''?></textarea>
    <?php if (isset($errors['desc'])): ?>
        <?php foreach ($errors['desc'] as $el): ?>
            <i style="color: indianred"><?= $el ?></i>
        <?php endforeach; ?>
    <?php endif; ?>
    <br>

    <label for="status">Статус:</label>
    <br>
    <select name="status">
        <?php foreach ($statusList as $item): ?>
            <option value="<?=$item['id'] ?>"
                    <?= isset($post['status']) &&
                                $post['status'] === $item['name'] ? 'selected' : ''?> >
                <?= $item['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>


    <button type="submit">Сохранить</button>

    <script src="/js/showImg.js"></script>

</form>
    <button href="/">Удалить продукт</button>
