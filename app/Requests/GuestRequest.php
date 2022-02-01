<?php

namespace App\Requests;

use App\User;

class GuestRequest
{
    function __construct()
    {
        if( User::isLoggedIn() )
            abort('You should be a guest to see this page.');
    }
}