<?php

namespace App\Requests\POST;
use App\Requests\AuthenticatedRequest;
use App\Requests\PostRequest;
use App\User;

class ProfileDeleteLink extends AuthenticatedRequest {

    use PostRequest;

    public $required = [ 'slug' ];

    public function handle()
    {
        $slug = $_POST['slug'];
        $statement = db()->prepare('SELECT count(*) FROM urls WHERE user_id=? AND slug=?');
        $statement->execute([ User::me()->id, $slug ]);
        if( $statement->fetchColumn() != 1 )
            dm('Something went wrong');

        $statement = db()->prepare('DELETE FROM urls WHERE user_id=? AND slug=?');
        $statement->execute([ User::me()->id, $slug ]);
        dm('Link deleted successfully');
    }
}