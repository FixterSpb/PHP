<?php

$currentValidator = [
    'ruleTypes' => [
        'required' => function(array $data, string $field) :bool {
            return (bool) array_get($data, $field);
        },
        'email' => function(array $data, string $field):bool {
            return (bool)preg_match('/^[\w._,?-]+@\w+\.\w{2,}$/', array_get($data, $field));
        }
    ],
    'rules' => [
        'userName' => 'required',
        'password' => 'required',
        'confirmPassword' => 'required',
        'email' => 'email',
    ],
    'rulesMessage' => [
        'required' => 'Поле обязательно для заполнения!',
        'email' => 'Необходимо ввести существующий E-mail!'
    ]
];

$currentValidator['validate'] = function($req) use($currentValidator) {
    $errors = [];

    foreach($currentValidator['rules'] as $key => $value){
        if(!$currentValidator['ruleTypes'][$value]($req, $key)){
            $errors[$key] = $currentValidator['rulesMessage'][$value];
        }
    }

    return $errors;
};

return $currentValidator;