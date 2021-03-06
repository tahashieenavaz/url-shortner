<?php

namespace App\Requests;

use App\User;

class AuthenticatedRequest {
    function __construct()
    {
        if( ! User::isLoggedIn() )
            abort('Unauthenticated.');
    }
}