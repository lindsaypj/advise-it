<?php

function validToken(string $token) {
    // validate length
    if (strlen($token) != 6) {
        return false;
    }

    // Allowed chars (letters and numbers)
    if (!ctype_alnum($token)) {
        return false;
    }

    return true;
}

function generateToken() {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, 6);
}