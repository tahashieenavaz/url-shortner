<?php

use App\Requests\GET\IndexPage;
use App\Requests\POST\ProcessLogin;
use App\Requests\POST\ProcessRegister;

$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$db = new PDO("sqlite:".__DIR__."/database.sql");

// Handling POST Requests
if( $method == 'POST' ) {
    $map = [
        '/login' => 'ProcessLogin',
        '/register' => 'ProcessRegister'
    ];
}elseif( $method == 'GET' ) {
    // Handling GET request
    $map = [
        '/' => 'IndexPage'
    ];
}

