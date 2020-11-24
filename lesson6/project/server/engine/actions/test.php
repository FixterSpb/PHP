<?php

    $str = $_GET['str'];

    var_dump(preg_match('/^\d+\.?\d{0,2}$/', $str));