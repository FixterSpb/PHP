<?php

/*
 * 4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation),
 * где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции.
 * В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3)
 * и вернуть полученное значение (использовать switch).
 */

include './03.php';

function mathOperation($arg1, $arg2, $operation){

    switch ($operation){
        case 'sum':
            return sum($arg1, $arg2);
        case 'diff':
            return diff($arg1, $arg2);
        case 'comp':
            return comp($arg1, $arg2);
        case 'quot':
            return quot($arg1, $arg2);
        default:
            return "\"$operation\" - incorrect. Valid values: 'sum', 'diff', 'comp' or 'quot'";
    }
}

echo mathOperation(10, 20, 'sum'), '<br>';
echo mathOperation(10, 20, 'diff'), '<br>';
echo mathOperation(10, 20, 'comp'), '<br>';
echo mathOperation(40, 20, 'quot'), '<br>';
echo mathOperation(40, 20, 'invalid'), '<br>';