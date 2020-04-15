<?php

namespace App\Http\Request;

class Route {

    private $uri;

    public function __construct()
    {
        $this->uri = array_filter(explode('/', getenv('REQUEST_URI')));
    }

    public function get()
    {
        return json_encode($this->uri);
    }
}