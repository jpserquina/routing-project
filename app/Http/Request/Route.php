<?php

namespace App\Http\Request;

class Route {

    private $uri;
    private $method;

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';
    const METHOD_INVALID = 'method_invalid';

    public function __construct()
    {
        $this->split_uri();
        $this->filter_methods();
    }

    public function set_uri($uri)
    {
        $this->uri = $uri;
    }

    public function get_uri()
    {
        return $this->uri;
    }

    public function set_method(string $method)
    {
        $this->method = $method;
    }

    public function get_method()
    {
        return $this->method;
    }

    public function get()
    {
        if ($this->get_method() === self::METHOD_GET)
        {
            return json_encode($this->get_uri());
        }
    }

    private function split_uri(): void
    {
        $result = array_filter(
            explode(
                '/',
                getenv('REQUEST_URI')
            ),
            function($item) {
                if (!in_array($item, ['routing-project', 'public']))
                {
                    return $item;
                }
                return '';
            }
        );
        $result = array_values($result);
        $uri_array = [];
        for ($i = 0; $i < count($result); $i = $i + 2) {
            $uri_array[ $result[$i] ] = $result[$i + 1];
        }
        $this->set_uri($uri_array);
    }

    private function filter_methods(): void
    {
        $method = getenv('REQUEST_METHOD');

        switch ($method)
        {
            case self::METHOD_GET:
                $this->set_method(self::METHOD_GET);
                break;
            case self::METHOD_POST:
                $this->set_method(self::METHOD_POST);
                break;
            case self::METHOD_PATCH:
                $this->set_method(self::METHOD_PATCH);
                break;
            case self::METHOD_DELETE:
                $this->set_method(self::METHOD_DELETE);
                break;
            default:
                $this->set_method(self::METHOD_INVALID);
        }
    }
}