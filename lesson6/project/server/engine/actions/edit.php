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
        $content = view('parts/header',
                [
                    'title' => $title,
                ]
            ) . view('forms/editProduct', $params);
        require PAGES . 'home.php';
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
                    'post' => $post,
                    'errors' => $errors,
                    'statusList' => $statusList,
                ]);
        }

        switch ($action){
            case 'create':
                dbCreateProduct($dbConnection, $post);
                break;
            case 'update':
                print_r($post);
                die;
                dbUpdateProduct($dbConnection, $post);
                break;
            default:
                abort(404);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET'){
        if (!isset($_GET['action'])){
            abort(404);
        }

        $action = dbEscape($dbConnection, $_GET['action']);

        if ($action === 'create'){
            showPageEdit($title,
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
                    'post' => $product,
                    'statusList' => $statusList,
                ]);
        }

        abort(404);
    }




