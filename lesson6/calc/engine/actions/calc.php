<?php

    $params = [];
    if(!isset($_GET) || sizeof($_GET) === 0){
        $params = ['action' => 'calc.php', 'math_act' => '+'];
    }else{
        $params = ['action' => 'calc.php', 'math_act' => '+'];
        $errors = [];
        if (!isset($_GET['num1'])){
            $errors['num1'] = 'Поле обязательно для заполнения';
        }else{
            $params['num1'] = $_GET['num1'];
        }
        if (!isset($_GET['num2'])){
            $errors['num2'] = 'Поле обязательно для заполнения';
        }else{
            $params['num2'] = $_GET['num2'];
        }
        if (!isset($_GET['math_act'])){
            $params['math_act'] = '+';
        }else{
            $params['math_act'] = $_GET['math_act'];
        }

        if (sizeof($errors) > 0) {
            $params['errors'] = $errors;
        }else{
            $params['result'] = calculate($_GET['num1'], $_GET['num2'], $_GET['math_act']);
        }
    }

    $content = view('forms/calc', $params);
    require TEMPLATES . 'main.php';
