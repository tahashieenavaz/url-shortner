<?php

namespace App\Requests\POST;

use App\Requests\GuestRequest;
use App\Requests\PostRequest;
use App\Str;

class ProcessRegister extends GuestRequest {
    use PostRequest;

    public $required = ['name', 'email', 'password'];

    public function handle() {
        checkVar($_REQUEST['email'], FILTER_VALIDATE_EMAIL, 'Enter a valid email address please.');
        $email = $_REQUEST['email'];
        $password = Str::hash( $_REQUEST['password'] );
        $name = $_REQUEST['name'];

        $statement = db()->prepare('SELECT count(*) FROM users WHERE email=?');
        $statement->execute([$email]);

        if( $statement->fetchColumn() )
            dm('Email already exists');


        $statement = db()->prepare('INSERT INTO users(name, email, password) VALUES(?,?,?)');

        $result = $statement->execute([
            $name,
            $email,
            $password
        ]);
        if( $result )
            dm('User created successfully');

        dm('Something went wrong!');
    }
}