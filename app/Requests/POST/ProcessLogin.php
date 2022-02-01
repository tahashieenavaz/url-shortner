<?php

namespace App\Requests\POST;

use App\Requests\GuestRequest;
use App\Requests\PostRequest;
use App\Str;
use App\User;

class ProcessLogin extends GuestRequest {

    use PostRequest;

    public $required = ['email', 'password'];

    public function handle() {
        checkVar($_REQUEST['email'],FILTER_VALIDATE_EMAIL,'Wrong Email');
        $email = $_REQUEST['email'];
        $password = Str::hash($_REQUEST['password']);
        echo User::login( $email, $password );
    }

}