    <h1 style="text-align: center"><?= $title ?></h1>
    <nav class="mainMenu">
        <ul class="mainMenu__menu">
            <?php foreach ($menuList as $item): ?>
            <li class="<?= $item['active'] ? 'mainMenu__item-active' : 'mainMenu__item'?>">
                <a class="mainMenu__link
                    <?= $item['active'] ? 'mainMenu__link-active' : ''?>"
                   href="<?= $item['link'] ?>">
                    <?= $item['name'] ?>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </nav>
