<?php 

define('DOC_ROOT', __DIR__ . '/../');
define('PUBLIC_DIR', DOC_ROOT . 'public/');
define('ENGINE', DOC_ROOT . 'engine/');
define('ACTIONS', ENGINE . 'actions/');
define('HELPERS', ENGINE . 'helpers/');
define('TEMPLATES', DOC_ROOT . 'templates/');

require HELPERS . 'helper.php';


$uri = explode('/', $_SERVER['REQUEST_URI']);
$action = (isset($uri[1]) && $uri[1] !== '') ? $uri[1] : 'home';


$filePath = ACTIONS . $action . '.php';
if (!file_exists($filePath)){
    showError(404);
} else {
    require $filePath;
};

