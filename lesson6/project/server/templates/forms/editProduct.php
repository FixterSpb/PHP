<?php //var_dump($product) ?>
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
           value="<?= isset($product['name']) ? $product['name'] : ''?>" required>
    <?php if (isset($errors['name'])): ?>
        <?php foreach ($errors['name'] as $el): ?>
            <i style="color: indianred"><?= $el ?></i>
        <?php endforeach; ?>
    <?php endif; ?>
    <br>

    <label for="img">Картинка:</label>
    <br>
        <img id="img" src="<?= isset($product['img']) ? $product['img'] : '#' ?>" alt="">
    <br>
    <input type="text" name="img" style="display: none" value="<?= isset($product['img']) ? $product['img'] : '#' ?>">
    <input type="file" name="uploadImg">
    <br>

    <label for="price">Цена:</label>
    <br>
    <input type="text" name="price" placeholder="0.00"
           value="<?= isset($product['price']) ? $product['price'] : ''?>"
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
        ><?= isset($product['desc']) ? $product['desc'] : ''?></textarea>
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
                    <?= (isset($product['status']) &&
                                $product['status'] === $item['id']) ? 'selected' : ''?> >
                <?= $item['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>


    <button type="submit">Сохранить</button>

    <script src="/js/showImg.js?ver=1.002"></script>

</form>
    <button href="/">Удалить продукт</button>