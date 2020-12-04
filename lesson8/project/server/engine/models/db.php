<?php

    $dbModel['getConnection'] = function() {
        return $GLOBALS['dbConnection'];
    };

    $dbModel['query'] = function($sql) use($dbModel){

        $result = mysqli_query($dbModel['getConnection'](), $sql);

        if (!$result) {
            $result['error']['errNo'] = mysqli_errno($dbModel['getConnection']());
            $result['error']['errMessage'] = mysqli_error($dbModel['getConnection']());
        }
        return $result;
    };

    $dbModel['queryAll'] = function($sql) use ($dbModel){

        $resultQuery = $dbModel['query']($sql);

        $result = [];
        while ($item = mysqli_fetch_assoc($resultQuery)){
            $result[] = $item;
        }
        return $result;
    };

    $dbModel['queryOne'] = function($sql) use ($dbModel){

        return (array)mysqli_fetch_assoc($dbModel['query']($sql));
    };

    $dbModel['lastInsertId'] = function() use($dbModel) {
        return mysqli_insert_id($dbModel['getConnection']());
    };

    return $dbModel;
