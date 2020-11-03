<?php

/*
 * 8. *Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».
 */

$cities = array(
    "Московская область" => ["Москва", "Зеленоград", "Клин"],
    "Ленинградская область" => ["Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"],
    "Рязанская область" => ["Рязань", "Александро-Невский", "Ермишь", "Захарово"]
);

$cities_filtered = array_filter(
    array_map(function($region){
        return array_filter($region, function($city){
            return mb_strcut($city, 0, 2) === "К";
        });
    }, $cities), fn($item) => sizeof($item) > 0
);

foreach ($cities_filtered as $key => $value){
    echo "<b>$key</b>:<br>" . implode(", ", $value) . "<br>";
}
