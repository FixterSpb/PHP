<?php

define('DOC_ROOT', __DIR__ . '/../server/');

define('ENGINE', DOC_ROOT . 'engine/');
define('ACTIONS', ENGINE . 'actions/');
define('HELPERS', ENGINE . 'helpers/');

define('TEMPLATES', DOC_ROOT . 'templates/');
define('PAGES', TEMPLATES . 'pages/');
define('CONFIG', DOC_ROOT . 'config/');

define('DATA', DOC_ROOT . 'data/');
define('LOGS', DATA . 'logs/');



/*
 * Обе константы указывают в одну папку, однако для загрузки на локальный сервер
 * необходим полный путь, а для отображения на странице - относительный.
 *
 * Во всяком случае, у меня иначе не получается
 */
define('UPLOAD_IMG', '/img/');
define('UPLOAD_FILE', __DIR__ . UPLOAD_IMG);

require  HELPERS . 'helper.php';

require HELPERS . 'database.php';
$dbConnection = dbConnect();

if(!array_get($_COOKIE, 'hash_cart')){
    $hash_cart = hash('sha256', date('U'));
    setcookie('hash_cart', $hash_cart);
}

$uri = array_values(
        array_filter(
            explode('/',
                explode('?',
                    $_SERVER['REQUEST_URI'])
                [0]),
            fn($el) => boolval($el)
        ));

$i = 0;

$currentAction = array_get($uri, 0, 'home');
$filePath = ACTIONS . $currentAction;

if (is_dir($filePath)){

    $filePath .= '/' . array_get($uri, 1, $currentAction);
}

$filePath .=  '.php';

if (!file_exists($filePath) || is_dir($filePath)){
    abort(404);
}

require $filePath;
