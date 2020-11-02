<?php

/*
 * 6. *С помощью рекурсии организовать функцию возведения числа в степень.
 * Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
 */

/**
 * Функция возводит число в степень
 * @param $val float | int Возводимое число
 * @param $pow int показатель степени (больше или равен 0!)
 * @return float
 */
function power($val, $pow){
    if ($pow < 0 || $pow - floor($pow)  != 0) return 'error';
    if ($pow == 0) return 1;
    if ($pow == 1) return $val;
    return $val * power($val, $pow - 1);
}

echo '2<sup>0</sup> = ', power(2, 0), '<br>';
echo '2<sup>1</sup> = ', power(2, 1), '<br>';
echo '2<sup>5</sup> = ', power(2, 5), '<br>';
echo '2<sup>5.5</sup> = ', power(2, 5.5);
