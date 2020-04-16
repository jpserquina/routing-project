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
     */
    public static function view(array $data): void {
        echo json_encode($data);
    }
}