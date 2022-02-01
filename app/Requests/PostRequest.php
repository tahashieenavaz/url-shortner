<?php

namespace App\Requests;

class PostRequest {
    public $required = [];

    public function __construct()
    {
        foreach($this->required as $requiredItem) {
            if( ! array_key_exists($requiredItem, $_POST) ) {
                die("Enter Credentials Rights");
            }
        }
    }

}