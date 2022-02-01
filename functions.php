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

function message( $content ) {
    return json_encode([
        'message' => $content
    ]);
}

function dm( $content ) {
    echo json_encode([
        'message' => $content
    ]);

    exit;
}

function response($content) {
    echo json_encode($content);
}