<?php

namespace App;

class Cache
{
    const MINUTES = 1 / 12;

    public static function slug($name) {
        return CACHE.hash('xxh3', $name);
    }



    public static function remember($name, $callback)
    {
        if( self::exists($name))
            return self::load($name);

        $output = $callback();
        file_put_contents(self::slug($name), serialize($output), 2);
        return $output;
    }

    public static function exists($name) {
        if( ! file_exists(self::slug($name)) )
            return false;

        return true;
    }

    public static function load($name, $default = null)
    {
        if( ! self::exists($name) ) return null;

        if( file_exists(self::slug($name)) && filemtime(self::slug($name)) > (time() - 60 * self::MINUTES) ) {
            // Cache Valid, so load it
            return unserialize(file_get_contents(self::slug($name)));
        }

        if( file_exists(self::slug($name)) && filemtime(self::slug($name)) < (time() - 60 * self::MINUTES) ) {
            // Cache invalid
            $output = file_get_contents(self::slug($name));
            unlink(self::slug($name));
            return unserialize($output);
        }

    }
}