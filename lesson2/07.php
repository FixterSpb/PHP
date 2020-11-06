<?php

/*
 * 7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
 * 22 часа 15 минут
 * 21 час 43 минуты
 */

function printDate(){
    $hour = +date('h');
    $minute = +date('i');

    if ($hour == 0 || $hour > 4 && $hour <= 20) $hour .= ' часов ';
    else if ($hour % 10 == 1) $hour  .= ' час ';
    else $hour .= ' часа ';

    if ($minute % 10 == 0 || $minute % 10 > 4 && $minute % 10 <= 9 || floor($minute / 10) == 1) $minute .= ' минут';
    else if ($minute % 10 == 1) $minute  .= ' минута';
    else $minute .= ' минуты';

    return $hour . $minute;
}

echo printDate();