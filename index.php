<?php
session_start();
header('Content-Type: application/json');

require 'vendor/autoload.php';

use App\Cache;

use App\HandleURLs;

define('DS',DIRECTORY_SEPARATOR );
define('PATH', __DIR__ . DS);
define('CACHE', PATH.'cache'.DS );

$method = $_SERVER['REQUEST_METHOD'];

if( strpos($_SERVER['REQUEST_URI'], '?') )
    $target = substr($_SERVER['REQUEST_URI'], 0, strpos( $_SERVER['REQUEST_URI'], '?' ));
else
    $target = $_SERVER['REQUEST_URI'];

$db = new PDO("sqlite:".__DIR__."/database.sqlite");

// Handling POST Requests
if( $method == 'POST' ) {
    $map = [
        '/login' => 'ProcessLogin',
        '/register' => 'ProcessRegister',
        '/logout' => 'ProcessLogout',
        '/profile/add' => 'ProfileAddLink',
        '/profile/edit' => 'ProfileEditLink',
        '/profile/delete' => 'ProfileDeleteLink',
    ];
}elseif( $method == 'GET' ) {
    // Handling GET request
    $map = [
        '/' => 'IndexPage',
        '/profile' => 'ProfilePage',
    ];

    (new HandleURLs)($target, $map);
}

$class = $map[$target];
$class = "App\Requests\\$method\\$class";
(new $class)->handle();
