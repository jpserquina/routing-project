<?php

require_once '../app/init.php';

use App\Http\Request\Route as Route;

$route = new Route();
echo $route->get();