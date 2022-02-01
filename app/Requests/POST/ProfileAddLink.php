<?php
namespace App\Requests\POST;
use App\Requests\AuthenticatedRequest;
use App\Requests\PostRequest;
use App\User;

class ProfileAddLink extends AuthenticatedRequest {
    use PostRequest;
    public $required = ['slug', 'target'];
    public function handle()
    {
        checkVar($_POST['target'], FILTER_VALIDATE_URL, 'Enter a valid URL');
        $slug = $_POST['slug'];
        $target = $_POST['target'];

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

        dm('URL added successfully');
    }

}