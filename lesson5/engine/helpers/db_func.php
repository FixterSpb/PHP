<?php

if (!function_exists('fillDb')){
    function fillDB($link){
        $path = 'img/';
        $images = scandir($path);
        echo "<br>";
        foreach ($images as $item){
            if (preg_match('/.+\.jpg/', $item)){
                echo filesize($path . $item) . "<br>";
                print_r(getimagesize($path . $item));
                echo ("<br>");
                $query = "INSERT INTO `images` (`path`, `size`, `popularity`) VALUES ('" . $path . $item . "', 15, 20);";
                var_dump(mysqli_query($link, $query));
                echo $query . "<br><hr>";

            }
        }
        echo "<br>";
        var_dump($images);
    }
}
