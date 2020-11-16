<?php

define('DOC_ROOT', __DIR__ . '/../');
define('ENGINE', DOC_ROOT . 'engine/');
define('ACTIONS', ENGINE . 'actions/');
define('TEMPLATES', DOC_ROOT . 'templates/');
define('HELPERS', ENGINE . 'helpers/');

require  HELPERS . 'helper.php';
require  HELPERS . 'math.php';

require ACTIONS . 'calc.php';