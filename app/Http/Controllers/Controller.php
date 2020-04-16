<?php

namespace App\Http\Controllers;

class Controller extends GenericController {

    /**
     *
     */
    public static function get()
    {
        return self::view(phpinfo());
    }
}