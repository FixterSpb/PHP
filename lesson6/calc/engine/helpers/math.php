<?php

if (!function_exists('calculate')){
    function calculate($num1, $num2, $action){
        if(!is_numeric($num1)){
            return "'$num1' - это не число!";
        }
        if(!is_numeric($num2)){
            return "'$num2' - это не число!";
        }

        switch ($action){
            case "+":
                return sum($num1, $num2);
            case "-":
                return diff($num1, $num2);
            case "/":
                return quot($num1, $num2);
            case "x":
                return comp($num1, $num2);
            default:
                return "неизвестное действие: $action";
        }
    }
}

if (!function_exists('sum')){
    function sum($num1, $num2){
        return $num1 + $num2;
    }
}

if (!function_exists('diff')){
    function diff($num1, $num2){
        return $num1 - $num2;
    }
}

if (!function_exists('comp')){
    function comp($num1, $num2){
        return $num1 * $num2;
    }
}

if (!function_exists('quot')){
    function quot($num1, $num2){
        if ($num2 == 0) {
            return "Деление на 0 запрещено!";
        }
        return $num1 / $num2;
    }
}
