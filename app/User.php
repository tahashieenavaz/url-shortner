<?php

namespace App;

class User {

    public static function setLoginSession( $email ) {
        $_SESSION['login'] = true;
        $_SESSION['current_email'] = $email;
    }

    public static function me() {
        if(! self::isLoggedIn())
            return null;

        $statement = db()->prepare('SELECT id,name,email FROM users WHERE email=?');
        $statement->execute([$_SESSION['current_email']]);
        $user = $statement->fetch(\PDO::FETCH_OBJ);

        return $user;
    }

    public static function isLoggedIn() {
        return array_key_exists('login', $_SESSION) && ! empty($_SESSION['current_email']);
    }

    public static function logout() {
        unset($_SESSION['login']);
        unset($_SESSION['current_email']);
        session_destroy();
    }

    public static function login($email, $password) {
        $result = db()->prepare("SELECT name,email FROM `users` WHERE email=? AND password=?");
        $result->execute([$email, $password]);
        $results = $result->fetchAll(\PDO::FETCH_ASSOC);

        if( count( $results ) == 1 ) {
            // Valid User Found
            self::setLoginSession($email);
            return json_encode($results[0]);
        }

        return json_encode([
            'message' => 'Login unsuccessful'
        ]);

    }

}