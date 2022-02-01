<?php

session_start();

header('Content-Type: application/json');

require 'vendor/autoload.php';

use App\Requests\GET\IndexPage;
use App\Requests\GET\ProfilePage;
use App\Requests\POST\ProcessLogin;
use App\Requests\POST\ProcessRegister;
use App\User;


$method = $_SERVER['REQUEST_METHOD'];

if( strpos($_SERVER['REQUEST_URI'], '?') ) {
    $target = substr($_SERVER['REQUEST_URI'], 0, strpos( $_SERVER['REQUEST_URI'], '?' ));
}else {
    $target = $_SERVER['REQUEST_URI'];
}

$db = new PDO("sqlite:".__DIR__."/database.sqlite");

// Handling POST Requests
if( $method == 'POST' ) {
    $map = [
        '/login' => 'ProcessLogin',
        '/register' => 'ProcessRegister'
    ];
}elseif( $method == 'GET' ) {
    // Handling GET request
    $map = [
        '/' => 'IndexPage',
        '/profile' => 'ProfilePage'
    ];

    $link = explode( '/', $target );

    if( ! array_key_exists($target, $map) && count( $link ) == 2 ) {
        // Serach for a Link instead of a static GET request
        $slug = $link[1];
        $statement = db()->prepare('SELECT * FROM urls WHERE slug=?');
        $statement->execute([ $slug ]);
        $urlsFetchedFromDatabase = $statement->fetch(PDO::FETCH_ASSOC);

        if( $urlsFetchedFromDatabase ) {
            // TODO: Change this behaviour to redirect
            // Link found
            echo json_encode($urlsFetchedFromDatabase);
        }else {
            // Link not found
            echo "404";
        }

        // Stop Execution
        exit;
    }

}

$class = $map[$target];
$class = "App\Requests\\$method\\$class";

(new $class)->handle();
