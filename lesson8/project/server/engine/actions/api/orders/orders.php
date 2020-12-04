<?php

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            require 'get.php';
            exit;
        default:
            abort(404);
    }
