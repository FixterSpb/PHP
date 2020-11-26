<?php

    $result = dbGetProducts($dbConnection);
    //vdd(json_encode($result));

    //Не уверен в правильности, но, вроде, работает
    header("Content-type: application/json");
    echo json_encode($result);
    exit;
