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

$uri = explode('/', $_SERVER['REQUEST_URI']);

$action = isset($uri[1]) && $uri[1] ? $uri[1] : 'home';

$filePath = ACTIONS . $action . '.php';

if (!file_exists($filePath)){
    abort(404);
}

require $filePath;