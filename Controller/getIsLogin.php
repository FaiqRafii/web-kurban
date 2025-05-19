<?php

session_start();

header('Content-Type: appplication/json');

if (isset($_SESSION['isLogin'])) {
    echo json_encode([
        "isLogin" => true
    ]);
} else {
    echo json_encode([
        "isLogin" => false
    ]);
}
