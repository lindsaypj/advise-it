<?php

/**
 * Class to store miscellaneous functions
 */
class Functions {
    static function generateToken() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 6);
    }
}
























