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
     * @return void
     */
    public static function view(array $data): void
    {
        echo json_encode($data);
    }
}