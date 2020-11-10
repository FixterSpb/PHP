<div style="margin: 0 auto; text-align: center">
    <?php foreach ($gallery as $img): ?>
        <a href="<?= $img ?>" target="_blank">
            <img width="200px" src="<?= $img ?>" alt="">
        </a>
    <?php endforeach; ?>
</div>

