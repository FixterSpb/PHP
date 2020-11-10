<?php

if(!function_exists('getJSON')){
    function getJSON(){
        $albumId = rand(1, 100);

        if (!($data = file_get_contents('http://jsonplaceholder.typicode.com/photos?albumId=' . $albumId))) {
            http_response_code(503);
            return require(TEMPLATES . '503.php');
        }
        return $data;
    }
}

if(!function_exists('getGallery4')){

	function getGallery(){
		$images = json_decode(getJSON());
		$result = "";
		foreach ($images as $item){
		    $result .= "
                <a href='$item->url' target='_blank'>
                    <img src='$item->thumbnailUrl' alt='$item->title' title='$item->title'>
                </a>";
        }
		return $result;
	}

}

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