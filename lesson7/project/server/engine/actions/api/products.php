<?php
    require HELPERS . 'json.php';
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        require 'api.php';
    }
    if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        require 'products/delete.php';
    };

    require 'api.php';
