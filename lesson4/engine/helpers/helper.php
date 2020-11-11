<?php

if(!function_exists('getGallery1')){

    function getGallery1(){
        $result = [];
        for ($i = 1; $i <= 15; $i++){
            $img = '/img/' . ($i >= 10 ? $i : ('0' . $i)) . '.jpg';
            array_push($result, $img);
        }
        return $result;
    }

}

if(!function_exists('getImgLinks')){

    function getImgLinks($dir){
        $images = array_map(fn($item) => $dir . $item, scandir($dir));
        return array_filter($images, fn($item) => preg_match('/.+\.jpg/', $item));
    }
}

if(!function_exists('showError')){
    function showError($code){
        http_response_code($code);
        return require TEMPLATES . $code . '.php';
    }
}