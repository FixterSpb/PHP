<?php

    $title = "Редактирование товара ";

    $statusList = [
        [
            'id' => 'active',
            'name' => 'активен'
        ],
        [
            'id' => 'deleted',
            'name' => 'удалён'
        ]
    ];
    $action = isset($post['action']) ? $post['action'] : 'read';
    $action = isset($get['action']) ? $get['action'] : $action;

    function showPageEdit($title, array $params){
        $header = view('parts/header',
            [
                'menuList' => getMainMenuList(),
                'title' => $title,
            ]
        );
        $content = view('forms/editProduct', $params);
        require PAGES . 'editProduct.php';
        die;
    }

    $validateRules =
        [
            'name' => ['required'],
            'price'  => ['required', 'price'],
            'desc'  => ['required'],
        ];




    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (!isset($_POST['action'])){
            abort(404);
        }

        $post = [];


        foreach ($_POST as $key => $value){
            $post[$key] = dbEscape($dbConnection, $value);
        }
        $action = $post['action'];

        if($errors = validate($post, $validateRules)){
            showPageEdit($title,
                [
                    'action' => $action,
                    'product' => $post,
                    'errors' => $errors,
                    'statusList' => $statusList,
                ]);
        }

        if($action !== 'create' && $action !== 'update'){

            abort(404);
        }

//        var_dump($_FILES);
//        echo "<br>";
////        var_dump
//        exit;
        if($_FILES['uploadImg']['tmp_name'] !== ''){
            $tmp = explode('.', $_FILES['uploadImg']['name']);
            $ext = end($tmp);
            $fileName = str_replace('.tmp', '.' . $ext, basename($_FILES['uploadImg']['tmp_name']));
            echo $fileName;
//            $path = 'd:/temp/upload/';
            move_uploaded_file($_FILES['uploadImg']['tmp_name'], UPLOAD_FILE . $fileName);
            $post['img'] = $fileName;
        }else{
            $tmp = explode('/', $post['img']);
            $post['img'] = end($tmp);
        }

        switch ($action){
            case 'create':
                dbCreateProduct($dbConnection, $post);
                break;
            case 'update':
                dbUpdateProduct($dbConnection, $post);
                break;
            default:
                echo $action;
                die;
                abort(404);
        }

        header("Location: /editMode");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        if (!isset($_GET['action'])){
            abort(404);
        }

        $action = dbEscape($dbConnection, $_GET['action']);

        if ($action === 'create'){
            showPageEdit('Добавление товара',
                [
                    'action' => $action,
                    'statusList' => $statusList,
                ]);
        }

        if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
            abort(404);
        }

        $id = dbEscape($dbConnection, $_GET['id']);

        if ($action === 'delete'){
            if ($result = dbDeleteProduct($dbConnection, $id)){
                header("Location: {$_SERVER['HTTP_REFERER']}");
                die;
            };

            print_r( $_SERVER);
        }


        if ($action === 'update'){
            $product = dbGetProductById($dbConnection, $id);
            showPageEdit($title,
                [
                    'action' => $action,
                    'id' => $id,
                    'product' => $product,
                    'statusList' => $statusList,
                ]);
        }

        abort(404);
    }




