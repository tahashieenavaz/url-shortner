<?php

namespace App;

class Cache
{
    const MINUTES = 10;

    public static function remember($name, $callback)
    {
        file_put_contents( CACHE.$name, $callback(), 2);
    }

    public static function exists($name) {
        if( ! file_exists(CACHE.$name) ) return false;
        return true;
    }

    public static function load($name, $default = null)
    {
        if( ! self::exists($name) ) return null;

        if( file_exists(CACHE.$name) && filemtime(CACHE.$name) > (time() - 60 * self::MINUTES) ) {
            // Cache Valid, so load it
            return file_get_contents(CAHCE.$name);
        }

        if( file_exists(CACHE.$name) && filemtime(CACHE.$name) < (time() - 60 * self::MINUTES) ) {
            // Cache invalid
            $output = file_get_contents(CAHCE.$name);
            unlink(CACHE.$name);
            return $output;
        }

    }
}