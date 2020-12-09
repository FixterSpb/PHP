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

if(!function_exists('array_log')){
    function array_log($module, $errors){
        write_log($module, array_toString($errors));
    }
}

if(!function_exists('array_toString')){
    function array_toString($arr){
        return implode(PHP_EOL, array_map(
            fn($key, $val) => "$key: $val",
            array_keys($arr), $arr
        ));
    }
}

if(!function_exists('array_clean')){
    function array_clean(array $arr){
        return array_map(function($item) {
            if (is_array($item)) {
                return array_clean($item);
            }

            return is_string($item) ? strip_tags(htmlspecialchars($item)) : $item;
        }, $arr);
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

        return isset($arr[$key]) ? htmlspecialchars(strip_tags($arr[$key])) : $default;
    }
}

if(!function_exists('getMainMenuList')){
    function getMainMenuList($active = null){

        $default =  [
            [
                'name' => 'Каталог товаров',
                'link' => '/',
                'active' => $active === 'Каталог товаров',
            ],
            [
                'name' => view('parts/cartCounter', []),
                'link' => '/cart',
                'active' => $active === 'Корзина'
            ],
            [
                'name' => 'Вход',
                'link' => '/login',
                'active' => $active === 'Вход'
            ],

        ];
        if (!array_get($_SESSION, 'permission')) {
            return $default;

        }else{
            switch ($_SESSION['permission']) {
                case "user":
                    return
                        [
                            [
                                'name' => 'Каталог товаров',
                                'link' => '/',
                                'active' => $active === 'Каталог товаров',
                            ],
                            [
                                'name' => view('parts/cartCounter', []),
                                'link' => '/cart',
                                'active' => $active === 'Корзина'
                            ],
                            [
                                'name' => 'Заказы',
                                'link' => '/orders',
                                'active' => $active === 'Заказы'
                            ],
                            [
                                'name' => 'Личный кабинет',
                                'link' => '/office',
                                'active' => $active === 'Личный кабинет'
                            ],
                            [
                                'name' => 'Выход',
                                'link' => '/logout',
                                'active' => $active === 'Выход'
                            ],
                        ];
                case "admin":
                    return
                        [
//                            [
//                                'name' => 'Каталог товаров',
//                                'link' => '/',
//                                'active' => $active === 'Каталог товаров',
//                            ],
                            [
                                'name' => 'Редактирование',
                                'link' => '/editmode',
                                'active' => $active === 'Редактирование',
                            ],
                            [
                                'name' => "Заказы",
                                'link' => '/orders/admin',
                                'active' => $active === 'Заказы'
                            ],
                            [
                                'name' => 'Личный кабинет',
                                'link' => '/office',
                                'active' => $active === 'Личный кабинет'
                            ],
                            [
                                'name' => 'Выход',
                                'link' => '/logout',
                                'active' => $active === 'Выход'
                            ],

                        ];
            }
        }
    }
}

if(!function_exists('loadModel')){
    function loadModel(string $name){
        $filePath = ENGINE . 'models/' . $name . '.php';
//        var_dump($filePath);
        if (!file_exists($filePath)) {
//            echo "Нет файла";
//            die;
            abort(404);
        }

        $result = require $filePath;
        if(!is_array($result)){
            abort(404);
        }

        return $result;
    }
}

if(!function_exists('getDataJson')) {
    function getDataJson()
    {
        require HELPERS . 'json.php';
        $validator = require ENGINE . 'validators/json.php';
        if (!$jData = file_get_contents('php://input')) {
            write_log('cart_json', "Ошибка передачи данных");
            errorJSON('Ошибка передачи данных 1');
        }


        if (!$data = json_decode($jData, true)) {
            write_log('cart_json', "Ошибка передачи данных");
            errorJSON('Ошибка передачи данных');
        };


        if ($errors = $validator[$_SERVER['REQUEST_METHOD']]($data)) {
            array_log('cart_json', $errors);
            errorJSON(array_toString($errors));
        }

        return $data;
    }
}
