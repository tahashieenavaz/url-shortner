<?php

namespace App\Requests\POST;

use App\Requests\PostRequest;
use App\User;

class ProcessLogin {

    use PostRequest;

    public $required = ['email', 'password'];

    public function handle() {
        checkVar($_POST['email'],FILTER_VALIDATE_EMAIL,'Wrong Email');
        $email = $_POST['email'];
        $password = hash('sha256', $_POST['password']);
        echo User::login( $email, $password );
    }

}