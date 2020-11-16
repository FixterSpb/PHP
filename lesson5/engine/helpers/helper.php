<?php

if(!function_exists('showError')){
    function showError($code){
        http_response_code($code);
        return require TEMPLATES . $code . '.php';
    }
}

if(!function_exists('writeLog')){

    function writeLog($log, $text){
        $filename = LOGS . $log . "_". date('dmY') . '.txt';
        file_put_contents($filename, date('H:i:s') . " " . $text . "\n", FILE_APPEND);
    }
}

if(!function_exists('view')){

    /**
     * Рендер шаблона в строку
     * @param string $path - путь к шаблону в папке TEMPLATES без расширения файла
     * @param array $data - данные для шаблона (ключ - имя переменной)
     * @return string - строка вывода
     * @example view('forms/login', ['action' => '/login'])
     */
    function view(string $path, array $data = []) : string {

        // Включение буферизации вывода
        ob_start();

        // Импортирует переменные из массива в текущую таблицу символов
        extract($data);

        require TEMPLATES . $path . '.php';

        // Возвращает содержимое буфера вывода
        $result = ob_get_contents();

        // Очистить (стереть) буфер вывода и отключить буферизацию вывода
        ob_end_clean();

        return $result;
    }
}
