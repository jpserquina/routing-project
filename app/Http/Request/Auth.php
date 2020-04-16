<?php

namespace App\Http\Request;

// TODO - implement proper auth, ideally via Symfony\Component\Security

/**
 * Class Auth
 * @package App\Http\Request
 */
class Auth {
    /**
     * @return bool
     */
    public static function validate()
    {
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            return true;
        }
        return false;
    }

    /**
     *
     */
    public static function do_401()
    {
        header('WWW-Authenticate: Basic');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Text to send if user hits Cancel button';
        exit;
    }
}