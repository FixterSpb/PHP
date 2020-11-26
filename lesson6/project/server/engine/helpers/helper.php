<?php

require HELPERS . 'devFunc.php';

if(!function_exists('abort')){
    function abort($code){
        http_response_code($code);
        require TEMPLATES . 'abort/' . $code . '.php';
        die;
    }
}

if(!function_exists('write_log')){
    function write_log($module, $mess){
        $filePath = LOGS . $module . '/';

        if (!file_exists(LOGS) || !is_dir(LOGS)){
            mkdir(LOGS);
        }

        if (!file_exists($filePath) || !is_dir($filePath)){
           mkdir($filePath);
        }

        $filePath .= date('d-m-Y') . '.log';
        file_put_contents($filePath, date('H:i:s   ') . $mess . PHP_EOL, FILE_APPEND);

    }
}

if(!function_exists('view')){

    /**
     * Рендер шаблона в строку
     * @param string $path - путь к шаблону в папке TPL_PATH без расширения файла
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

if(!function_exists('validate')){
    function validate(array $arr, array $validateRules){
        $errors = [];
        foreach ($validateRules as $key => $item){
            foreach ($item as $el){
                switch($el){
                    case 'required':
                        if (!isset($arr[$key]) || trim($arr[$key]) === ''){
                            $errors[$key][] = 'Поле обязательно для заполнения!';
                        }
                        break;
                    case 'price':
                        if (preg_match('/^\d+\.?\d{0,2}$/', $arr[$key]) !== 1){
                            $errors[$key][] = 'Должно быть вещественное число с точностью не более двух знаков!';
                        }

                }
            }

        }

        return $errors;
    }
}

if(!function_exists('array_get')){
    function array_get(array $arr, $key, $default = null){
        return isset($arr[$key]) ? $arr[$key] : $default;
    }
}

if(!function_exists('getMainMenuList')){
    function getMainMenuList($active = null){
        return
        [
            [
                'name'=> 'Каталог товаров',
                'link' => '/',
                'active' => $active === 'Каталог товаров',
            ],
            [
                'name' => 'Войти',
                'link' => '/',
                'active' => $active === 'Войти'
            ],
            [
                'name' => 'Корзина',
                'link' => '/cart',
                'active' => $active === 'Корзина'
            ],

        ];
    }
}
