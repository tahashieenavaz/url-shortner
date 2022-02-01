<?php
namespace App;

class HandleURLs {
    public function __invoke( $target, $map ) {
        echo Cache::remember( $target, function() use($target, $map){
            $link = explode( '/', $target );

            if( ! array_key_exists($target, $map) && count( $link ) == 2 ) {
                // Search for a Link instead of a static GET request
                $slug = $link[1];
                $statement = db()->prepare('SELECT * FROM urls WHERE slug=?');
                $statement->execute([ $slug ]);
                $urlsFetchedFromDatabase = $statement->fetch(\PDO::FETCH_ASSOC);

                if( $urlsFetchedFromDatabase ) {
                    // TODO: Change this behaviour to redirect, if view needed
                    // Link found
                    return json_encode($urlsFetchedFromDatabase);
                }else {
                    // Link not found
                    return "404";
                }
            }
        }); // </Remember>
    }
}