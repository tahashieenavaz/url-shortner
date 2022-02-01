<?php

namespace App;

class Str {

    public static function hash( $string )
    {
        return hash('sha256', $string);
    }
}