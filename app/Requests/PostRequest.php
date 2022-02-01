<?php

namespace App\Requests;

trait PostRequest {

    public function __construct()
    {
        if( (bool) class_parents($this) )
            parent::__construct();

        foreach($this->required as $requiredItem) {
            if( ! array_key_exists($requiredItem, $_REQUEST) ) {
                response([
                    'message' => 'Provide full data please',
                    'required' => $this->required
                ]);
                die;
            }
        }
    }

}