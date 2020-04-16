<?php

namespace App\Http\Controllers;

use App\PatientsMetrics;

/**
 * Class PatientsMetricsController
 * @package App\Http\Controllers
 */
class PatientsMetricsController extends GenericController {

    public static function index($patientId)
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
            func_get_args(),
            '$patientId' => $patientId,
        ]);
    }

    public static function get($patientId, $metricId)
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
            func_get_args(),
            '$patientId' => $patientId,
            '$metricId' => $metricId,
        ]);
    }

    public static function create($patientId)
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
            func_get_args(),
            '$patientId' => $patientId,
        ]);
    }

    public static function update($patientId, $metricId)
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
            func_get_args(),
            '$patientId' => $patientId,
            '$metricId' => $metricId,
        ]);
    }

    public static function delete($patientId, $metricId)
    {
        return self::view([
            'model' => __CLASS__,
            'action' => __METHOD__,
            func_get_args(),
            '$patientId' => $patientId,
            '$metricId' => $metricId,
        ]);
    }
}