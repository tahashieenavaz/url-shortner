<?php

namespace App\Requests\POST;

use App\Requests\PostRequest;
use App\User;

class ProcessLogin {

    use PostRequest;

    public $required = ['email', 'password'];

    public function handle() {
        checkVar($_REQUEST['email'],FILTER_VALIDATE_EMAIL,'Wrong Email');
        $email = $_REQUEST['email'];
        $password = hash('sha256', $_REQUEST['password']);
        echo User::login( $email, $password );
    }

}