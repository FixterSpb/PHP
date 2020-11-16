<?php

if (!function_exists('fillDb')){
    function fillDB($link){
        $images = scandir(PATH_IMAGES);
        echo "<pre>";
        print_r($images);
        $i = 1;
        foreach ($images as $item){
            if (preg_match('/.+\.jpg/', $item)){
                $imageSize = getimagesize(PATH_IMAGES . $item);
                $query = "INSERT INTO `". DB_IMAGES_TABLE . "` (`name`, `path`, `size`, `popul`) VALUES ('Картинка " . $item . "', '" . $item . "', '" . $imageSize[0] . " x ". $imageSize[1] . "', 0)";
                echo $i++, ". ", $query, "<br>";
                if (!mysqli_query($link, $query)){
                    writeLog('database', mysqli_error($link));
                };
            }
        }
    }
}

if (!function_exists('dbGetGallery')){

    function dbGetGallery($link){
        $query = 'SELECT * FROM `' . DB_IMAGES_TABLE . '` ORDER BY `popul` DESC';

        $resultSQL = mysqli_query($link, $query);
        if (!$resultSQL){
            writeLog('database', mysqli_error($link));
            return;
        }
       return resultSQLToArr($resultSQL);

    }
}

if(!function_exists('dbGetImageById')){
    function dbGetImageById($link, $id){
        $query = 'SELECT * from `' . DB_IMAGES_TABLE . '` WHERE `id`='. $id . ';';
        $resultSQL = mysqli_query($link, $query);
        if (!$resultSQL){
            writeLog('database', mysqli_error($link));
            return;
        }

        $result = resultSQLToArr($resultSQL);
        if (!isset($result[0])){
            return;
        }
        return $result[0];
    }
}

if (!function_exists('dbPopulIncById')){
    function dbPopulIncById($link, $id){
        if (!$img = dbGetImageById($link, $id)){
            return;
        }

        $query = "UPDATE `" . DB_IMAGES_TABLE . "` SET `popul` = '" . ($img['popul'] + 1) ."' WHERE `id` = " . $id . ";";
        $resultSQL = mysqli_query($link, $query);
        if (!$resultSQL){
            writeLog('database', mysqli_error($link));
            return;
        }
    }
}

if (!function_exists('resultSQLToArr')){
    function resultSQLToArr($resultSQL){
        $result = [];
        while ($row = mysqli_fetch_assoc($resultSQL)){
            array_push($result, $row);
        }
        return $result;
    }
}
