<?php

include "./04.php";
include "./05.php";

function transSpace($str){
    return replaceSpace(translit($str));
}

echo transSpace("Проверка задания № 9.<br>");
