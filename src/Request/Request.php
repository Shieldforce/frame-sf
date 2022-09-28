<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Request;

use Shieldforce\FrameSf\Router\Route;

class Request
{
    private static ?Request $instance;

    private object $post;

    private object $get;

    private object $server;

    private object $all;

    private object $agent;

    private string $method;

    private array $headers;

    private Route $getCurrentRoute;

    private function __construct()
    {
        $this->headers = getallheaders();
        $this->post = (object) $_POST;
        $this->get = (object) $_GET;
        $this->server = (object) $_SERVER;
        $this->method = (string) $_SERVER["REQUEST_METHOD"];
        $this->agent = (object) [
            "browser" => (object) getBrowser(),
            "os" => (object)getOS(),
        ];
        $this->all = (object)[
            "post" => $this->post,
            "get" => $this->get,
            "server" => $this->server,
            "agent" => $this->agent,
        ];
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getInstance(): Request
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function post(): object
    {
        return $this->post;
    }

    public function get(): object
    {
        return $this->get;
    }

    public function server(): object
    {
        return $this->server;
    }

    public function all(): object
    {
        return $this->all;
    }

    public function method()
    {
        return $this->method;
    }

    public function agent(): object
    {
        return $this->agent;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setCurrentRoute(Route $route) : void
    {
        $this->route = $route;
    }

    public function getCurrentRoute() : Route
    {
        return $this->route ?? Route::getInstance();
    }

}