<?php

namespace App\Requests\GET;

use App\Requests\AuthenticatedRequest;

class ProfilePage extends AuthenticatedRequest {
    public function handle()
    {
        echo "Profile Page";
    }
}