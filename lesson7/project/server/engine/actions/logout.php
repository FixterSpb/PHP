<?php
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
    unset($_SESSION['permission']);

    header("Location: /");
    exit;

