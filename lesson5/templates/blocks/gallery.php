<div style="display: flex; flex-wrap: wrap; justify-content: space-around; margin: 0 auto; text-align: center" id="gallery">
    <?php foreach ($gallery as $img): ?>
        <div>
            <a href="image/?id=<?= $img['id'] ?>">
                <img width="200px" src="/<?= IMG . $img['path'] ;?>" alt="<?= $img['name'] ?>">
            </a>
<!--            <p>Популярность: --><?//= $img['popul'] ?><!--</p>-->
        </div>

    <?php endforeach; ?>
</div>

