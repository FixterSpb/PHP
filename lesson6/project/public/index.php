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

define('UPLOAD_IMG', '/img/');

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