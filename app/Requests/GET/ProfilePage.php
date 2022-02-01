<?php

namespace App\Requests\GET;

use App\Requests\AuthenticatedRequest;
use App\User;

class ProfilePage extends AuthenticatedRequest {
    public function handle()
    {
        $statement = db()->prepare('SELECT target, slug, created_at FROM urls WHERE user_id=?');
        $statement->execute([User::me()->id]);
        $urls = $statement->fetchAll(\PDO::FETCH_ASSOC);

        response($urls);
    }
}