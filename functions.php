<?php

function db() {
    global $db;
    return $db;
}

function dump( $message = '' ) {
    echo $message;
    exit;
}

function checkVar( $value, $method, $message = '' ) {
    if( ! filter_var($value, $method) )
        dump( $message );
}