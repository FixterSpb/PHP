<?php

    if(!function_exists('answerJSON')){
        function answerJSON(array $answer){
            header("Content-type: application/json");
            write_log('test', json_encode($answer));
            echo json_encode($answer);
            die;
        }
    }

    if(!function_exists('errorJSON')){
        function errorJSON($message){
            answerJSON(['result' => 1, 'errorMessage' => $message]);
        }
    }

    if(!function_exists('okJSON')){
        function okJSON($data) {
            answerJSON(['result' => 0, 'data' => $data]);
        }
    }
