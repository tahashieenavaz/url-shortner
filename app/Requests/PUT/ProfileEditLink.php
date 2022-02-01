<?php

namespace App\Requests\PUT;

use App\Requests\AuthenticatedRequest;
use App\Requests\PostRequest;
use App\User;

class ProfileEditLink extends AuthenticatedRequest {

    use PostRequest;

    public $required = ['slug', 'target'];

    public function handle()
    {
        checkVar($_REQUEST['target'], FILTER_VALIDATE_URL, 'Enter a valid URL for target input.');
        $slug = $_REQUEST['slug'];
        $target = $_REQUEST['target'];

        // Checking to see slug Doesnt exists
        $statement = db()->prepare('SELECT count(*) FROM urls WHERE slug=? AND user_id=?');
        $statement->execute([$slug, User::me()->id]);

        if( $statement->fetchColumn() != 1 )
            dm('Something went wrong');

        $statement = db()->prepare('UPDATE urls SET target=? WHERE user_id=? AND slug=?');
        if( $statement->execute([$target, User::me()->id, $slug]) )
            dm('Link edited successfully');

        dm('Something went wrong!');
    }

}