<?php
namespace App\Requests\POST;
use App\Requests\AuthenticatedRequest;
use App\Requests\PostRequest;
use App\User;

class ProfileAddLink extends AuthenticatedRequest {
    use PostRequest;
    public $required = ['target'];
    public function handle()
    {
        checkVar($_REQUEST['target'], FILTER_VALIDATE_URL, 'Enter a valid URL');
        $slug = substr(hash('sha256', microtime(true)),0, 7);
        $target = $_REQUEST['target'];

        // Checking to see slug Doesnt exists
        $statement = db()->prepare('SELECT count(*) FROM urls WHERE slug=?');
        $statement->execute([$slug]);

        if( $statement->fetchColumn() >= 1 )
            dm('Slug exists already');

        $statement = db()->prepare('INSERT INTO urls(target, slug, created_at, user_id) VALUES(?,?,?,?)');

        $statement->execute([
            $target,
            $slug,
            date('Y m d H:i:s'),
            User::me()->id,
        ]);

        response([
            'short' => URL . $slug,
            'target' => $target
        ]);
    }

}