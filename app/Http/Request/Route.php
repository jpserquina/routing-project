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
    private static $is_index;

    const GET = 'GET';
    const POST = 'POST';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';
    const METHOD_INDEX = 'index';
    const METHOD_GET = 'get';
    const METHOD_CREATE = 'create';
    const METHOD_UPDATE = 'update';
    const METHOD_DELETE = 'delete';

    /**
     * @param $uri
     */
    private static function set_uri($uri): void
    {
        self::$uri = $uri;
    }

    /**
     * @return array
     */
    private static function get_uri(): array
    {
        return self::$uri;
    }

    /**
     * @param $uri
     */
    private static function set_action($uri): void
    {
        self::$action = implode('.', array_keys($uri));
    }

    /**
     * @return string
     */
    private static function get_action(): string
    {
        return self::$action;
    }

    /**
     *
     */
    private static function split_uri(): void
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
        self::reset_is_index();

        for ($i = 0; $i < count($result); $i = $i + 2) {
            if (empty($uri_array[ $result[$i] ]))
            {
                if (!array_key_exists($i + 1, $result))
                {
                    self::set_is_index();
                    $result[$i + 1] = '';
                }
                $uri_array[ $result[$i] ] = $result[$i + 1];
            }
        }

        self::set_uri($uri_array);
        self::set_action($uri_array);
    }

    /**
     * @return bool
     */
    private static function is_index(): bool
    {
        return self::$is_index;
    }

    /**
     *
     */
    private static function set_is_index(): void
    {
        self::$is_index = true;
    }

    /**
     *
     */
    private static function reset_is_index(): void
    {
        self::$is_index = false;
    }

    /**
     *
     */
    public static function process(): void
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

        $class_name = self::get_class_name();
        $method_name = self::get_method_name($method);
        $params = self::get_params();

        $func = ["App\Http\Controllers\\" . $class_name, $method_name];
        $func(...$params);
    }

    /**
     * @param string $uri
     */
    public static function resource(string $uri): void
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
     * @return array
     */
    private static function get_actions(): array
    {
        return self::$routes;
    }

    /**
     * @param string $method
     * @return bool
     */
    private static function validate_access(string $method): bool
    {
        $is_get_method = ($method === self::GET);
        $validated = Auth::validate();

        return ($is_get_method || $validated);
    }

    /**
     *
     */
    private static function do_404(): void
    {
        http_response_code(404);
        echo '404 not found';
        die();
    }

    private static function do_500(): void
    {
        http_response_code(500);
        echo '500 an internal error occurred';
        die();
    }

    /**
     * @return string
     */
    private static function get_class_name(): string
    {
        $action = self::get_action();

        $uri_array = explode('.', $action);
        array_walk($uri_array, function(&$item) { $item = ucfirst($item); });
        $uri_array = implode('', $uri_array);

        return $uri_array . 'Controller';
    }

    /**
     * @param string $method
     * @return string
     */
    private static function get_method_name(string $method): string
    {
        switch (self::is_index()) {
            case true:
                if (in_array($method, [self::GET]))
                {
                    return self::METHOD_INDEX;
                }
                break;
            case false:
                break;
        }

        switch($method) {
            case self::GET:
                return self::METHOD_GET;
                break;
            case self::POST:
                return self::METHOD_CREATE;
                break;
            case self::PATCH:
                return self::METHOD_UPDATE;
                break;
            case self::DELETE:
                return self::METHOD_DELETE;
                break;
            default:
                return self::METHOD_INDEX;
        }
    }

    /**
     * @return array
     */
    private static function get_params(): array
    {
        return array_filter(array_values(self::get_uri()));
    }
}