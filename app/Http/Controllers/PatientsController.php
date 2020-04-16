<?php

namespace App\Http\Controllers;

use App\Patients;

/**
 * Class PatientsController
 * @package App\Http\Controllers
 */
class PatientsController extends GenericController {

    public static function index()
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
        ]);
    }

    public static function get($patientId)
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
            func_get_args(),
            '$patientId' => $patientId,
        ]);
    }

    public static function create()
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
        ]);
}

    public static function update($patientId)
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
            func_get_args(),
            '$patientId' => $patientId,
        ]);
    }

    public static function delete($patientId)
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
            func_get_args(),
            '$patientId' => $patientId,
        ]);
    }
}