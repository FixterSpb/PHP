<?php

    require HELPERS . 'json.php';

    if(!$result = dbGetProducts($dbConnection, [])) {
        errorJSON('Ошибка запроса');
    };

    okJSON($result);
