<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Request;

class Request
{
    private static ?Request $instance;

    private object $post;

    private object $get;

    private object $server;

    private object $all;

    private object $agent;

    private function __construct()
    {
        $this->post = (object) $_POST;
        $this->get = (object) $_GET;
        $this->server = (object) $_SERVER;
        $this->agent = (object) [
            "browser" => (object) getBrowser(),
            "os" => (object) getOS(),
        ];
        $this->all = (object) [
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

    public static function getInstance() : Request
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

    public function agent(): object
    {
        return $this->agent;
    }

}