<?php
/*
 * Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.
 */

function replaceSpace($str){
    return str_replace(" ", "_", $str);
}

echo replaceSpace("Проверка задания № 5.<br>");

