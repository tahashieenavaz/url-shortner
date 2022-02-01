<?php

namespace App\Requests\POST;

use App\User;

class ProcessLogout {

    public function handle() {
        User::logout();
        echo json_encode([
            'message' => 'Logout successful'
        ]);
    }

}