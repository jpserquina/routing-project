<?php

namespace App\Http\Request;

/**
 * Class Route
 * @package App\Http\Request
 */
class Route {

    private static $uri;
    private static $action;
    private static $routes;

    const GET = 'GET';
    const POST = 'POST';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';

    /**
     * @param $uri
     */
    private static function set_uri($uri)
    {
        self::$uri = $uri;
    }

    /**
     * @return mixed
     */
    private static function get_uri()
    {
        return self::$uri;
    }

    /**
     * @param $uri
     */
    private static function set_action($uri)
    {
        self::$action = implode('.', array_keys($uri));
    }

    /**
     * @return mixed
     */
    private static function get_action()
    {
        return self::$action;
    }

    /**
     *
     */
    private static function split_uri()
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
            if (empty($uri_array[ $result[$i] ]))
            {
                if (!array_key_exists($i + 1, $result))
                {
                    $result[$i + 1] = '';
                }
                $uri_array[ $result[$i] ] = $result[$i + 1];
            }
        }

        self::set_uri($uri_array);
        self::set_action($uri_array);
    }

    /**
     *
     */
    public static function process()
    {
        self::split_uri();

        $method = getenv('REQUEST_METHOD');
        $valid_access = self::validate_access($method);
        $current_action_in_registered_routes = in_array(self::get_action(), self::get_actions());

        $valid_request = $valid_access && $current_action_in_registered_routes;

        if (!$valid_access)
        {
            Auth::do_401();
        }

        if (!$valid_request)
        {
            self::do_404();
        }
    }

    /**
     * @param string $uri
     */
    public static function resource(string $uri)
    {
        $actions = array_filter(
            explode(
                '.',
                $uri
            )
        );

        self::$routes[] = implode('.', $actions);
    }

    /**
     * @return mixed
     */
    private static function get_actions()
    {
        return self::$routes;
    }

    /**
     * @param string $method
     * @return bool
     */
    private static function validate_access(string $method)
    {
        $is_get_method = ($method === self::GET);
        $validated = Auth::validate();

        return ($is_get_method || $validated);
    }

    /**
     *
     */
    private static function do_404()
    {
        http_response_code(404);
        echo '404 not found';
        die();
    }
}