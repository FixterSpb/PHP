<?php

    $currentValidator = [
        'ruleTypes' => [
            'required' => function(array $data, string $field) :bool {
                return (bool) array_get($data, $field);
            },
            'numeric' => function(array $data, string $field) :bool {
                return (bool) is_numeric(array_get($data, $field));
            },
            'positiveNumeric' => function (array $data, string $field): bool{
                $value = array_get($data, $field);
                return (bool) is_numeric($value) && $value > 0;
            }
        ],
        'ruleDelete' => [
            'id' => 'numeric'
        ],
        'rulePut' => [
            'id' => 'positiveNumeric',
            'quantity' => 'numeric'
        ]
    ];

    $currentValidator['DELETE'] = function($req) use($currentValidator) {
        $errors = [];
            if(!$currentValidator['ruleTypes']['numeric']($req, 'id')) {
                $errors['id'] = 'ошибка валидации';
            };
        return $errors;
    };

    $currentValidator['validate'] = function($req, $rule) use($currentValidator) {
        $errors = [];

        foreach($currentValidator[$rule] as $key => $value){
            if(!$currentValidator['ruleTypes'][$value]($req, $key)){
                $errors[$key] = "Ошибка валидации";
            }
        }
        if(!$currentValidator['ruleTypes']['numeric']($req, 'id')) {
            $errors['id'] = 'ошибка валидации';
        };
        return $errors;
    };

    $currentValidator['PUT'] = function($req) use($currentValidator){
        return $currentValidator['validate']($req, 'rulePut');
    };

    $currentValidator['POST'] = function($req) use($currentValidator){
        return [];
    };



    return $currentValidator;