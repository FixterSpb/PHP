<?php

    $validator = require ENGINE . 'validators/json.php';

    $stream = fopen('php://input', 'r');
    if (!$id = fread($stream, 1024)){
        write_log('delete_json', "Ошибка передачи данных");
        errorJSON('Ошибка передачи данных');
    }
    fclose($stream);

    if(!$data = json_decode($id, true)){
        write_log('delete_json', "Ошибка передачи данных");
        errorJSON('Ошибка передачи данных');
    };

    if($errors = $validator['DELETE']($data)){
        array_log('delete_json', $errors);
        errorJSON(array_toString($errors));
    }

    $id = dbEscape($dbConnection, array_get($data, 'id'));
    if (!dbDeleteProduct($dbConnection, $id)) {
        errorJSON("Ошибка базы данных");
    }

    if ($result = dbGetProductById($dbConnection, $id)){
        okJSON($result);
        errorJSON("Ошибка базы данных");
    }

    answerJSON($result);


//    answerJSON(['result' => 1, 'errorMessage']);
//    $validator['delete']()

