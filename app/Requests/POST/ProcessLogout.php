<?php

namespace App\Requests\POST;

use App\User;

class ProcessLogout {

    public function handle() {
        User::logout();
        return json_encode([
            'message' => 'Logout successful'
        ]);
    }

}