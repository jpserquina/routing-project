<?php

namespace App\Http\Controllers;

// TODO - implement a view renderer

/**
 * Class GenericController
 * @package App\Http\Controllers
 */
class GenericController {

    /**
     * @param array $data
     * @return string
     */
    public static function view(array $data): string
    {
        echo json_encode($data);
    }
}