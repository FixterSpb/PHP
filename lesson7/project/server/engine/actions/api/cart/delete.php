<?php

    if(!$result = dbDeleteProdFromCart($dbConnection, $id_cart, $data['id'])){
        errorJSON('Ошибка базы данных');
    };

    okJSON([]);
