<?php

if(!function_exists('vdd')){
    function vdd($value)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die;
    }
}
