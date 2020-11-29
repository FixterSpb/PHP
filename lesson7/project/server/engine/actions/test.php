<?php
/*
 * Не обращайте внимание, этот файл для отладки
 */
    abort(404);
    echo json_encode(dbGetProductById($dbConnection, $_GET['num']));
    echo "<br>";
