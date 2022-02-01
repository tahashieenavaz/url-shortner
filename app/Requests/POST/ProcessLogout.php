<?php

namespace App\Requests\POST;

use App\Requests\AuthenticatedRequest;
use App\User;

class ProcessLogout extends AuthenticatedRequest {

    public function handle() {
        User::logout();
        echo json_encode([
            'message' => 'Logout successful'
        ]);
    }

}