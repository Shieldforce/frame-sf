<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Router;

use Shieldforce\FrameSf\Controllers\Abstracts\AbstractController;
use Shieldforce\FrameSf\Errors\Custom\MethodIncorretException;
use Shieldforce\FrameSf\Errors\Custom\RouteInDuplicityException;
use Shieldforce\FrameSf\Request\Request;

class Route
{
    private static ?Route $instance;

    private string $uriFull;

    private string $uri;

    private array $url = [];

    private array $list;

    private array $modules;

    private object $routeCurrent;

    private function __construct()
    {
        $request = Request::getInstance();
        $this->uriFull = $request->all()->server->REQUEST_URI;
        $this->setUri();
        $this->url = parse_url($this->uri());
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getInstance() : Route
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function uri() : string
    {
        return $this->uri;
    }

    public function uriFull() : string
    {
        return $this->uriFull;
    }

    private function setUri() : void
    {
        $pattern = "/\?.*/";
        $source = $this->uriFull();
        $this->uri = preg_replace($pattern, "", $source);
    }

    public function setModules(array $modules) : void
    {
        $this->modules = $modules;
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function list()
    {
        return $this->list;
    }

    public function get(
        $fileOrigin,
        string $uri,
        AbstractController $controller,
        string $method,
        string $name,
        array $middlewares = []
    ) : Route
    {
        $this->list[] = (object) [
            "fileOrigin" => $fileOrigin,
            "uri" => $this->uri(),
            "httpMethod" => strtoupper(__FUNCTION__),
            "route" => $uri,
            "name" => $name,
            "controller" => $controller,
            "method" => $method,
            "middlewares" => $middlewares,
            "module" => $this->extractModule($fileOrigin),
            "requestGet" => request()->get(),
            "requestPost" => request()->post(),
        ];
        return $this;
    }

    public function post(
        $fileOrigin,
        string $uri,
        AbstractController $controller,
        string $method,
        string $name,
        array $middlewares = []
    ) : Route
    {
        $this->list[] = (object) [
            "fileOrigin" => $fileOrigin,
            "uri" => $this->uri(),
            "httpMethod" => strtoupper(__FUNCTION__),
            "route" => $uri,
            "name" => $name,
            "controller" => $controller,
            "method" => $method,
            "middlewares" => $middlewares,
            "module" => $this->extractModule($fileOrigin),
            "requestGet" => request()->get(),
            "requestPost" => request()->post(),
        ];
        return $this;
    }

    public function put(
        $fileOrigin,
        string $uri,
        AbstractController $controller,
        string $method,
        string $name,
        array $middlewares = []
    ) : Route
    {
        $this->list[] = (object) [
            "fileOrigin" => $fileOrigin,
            "uri" => $this->uri(),
            "httpMethod" => strtoupper(__FUNCTION__),
            "route" => $uri,
            "name" => $name,
            "controller" => $controller,
            "method" => $method,
            "middlewares" => $middlewares,
            "module" => $this->extractModule($fileOrigin),
            "requestGet" => request()->get(),
            "requestPost" => request()->post(),
        ];
        return $this;
    }

    public function delete(
        $fileOrigin,
        string $uri,
        AbstractController $controller,
        string $method,
        string $name,
        array $middlewares = []
    ) : Route
    {
        $this->list[] = (object) [
            "fileOrigin" => $fileOrigin,
            "uri" => $this->uri(),
            "httpMethod" => strtoupper(__FUNCTION__),
            "route" => $uri,
            "name" => $name,
            "controller" => $controller,
            "method" => $method,
            "middlewares" => $middlewares,
            "module" => $this->extractModule($fileOrigin),
            "requestGet" => request()->get(),
            "requestPost" => request()->post(),
        ];
        return $this;
    }

    public function path(
        $fileOrigin,
        string $uri,
        AbstractController $controller,
        string $method,
        string $name,
        array $middlewares = []
    ) : Route
    {
        $this->list[] = (object) [
            "fileOrigin" => $fileOrigin,
            "uri" => $this->uri(),
            "httpMethod" => strtoupper(__FUNCTION__),
            "route" => $uri,
            "name" => $name,
            "controller" => $controller,
            "method" => $method,
            "middlewares" => $middlewares,
            "module" => $this->extractModule($fileOrigin),
            "requestGet" => request()->get(),
            "requestPost" => request()->post(),
        ];
        return $this;
    }

    private function extractModule($fileOrigin)
    {
        $pattern = "/(.*)modules\//";
        preg_match($pattern, $fileOrigin, $matches);
        $replace = str_replace([$matches[0]], [""], $fileOrigin);
        $explode = explode("/", $replace);
        return $explode[0];
    }

    public function setCurrentRoute()
    {
        $verifySyncRouteInUri = $this->verifySyncRouteInUri();
        $request = request();
        if($request->method()!=$verifySyncRouteInUri[0]->httpMethod) {
            throw new MethodIncorretException("Método incorreto para rota! {$verifySyncRouteInUri[0]->uri}, O método esperado é : {$verifySyncRouteInUri[0]->httpMethod}.");
        }

        $this->routeCurrent = (object) $verifySyncRouteInUri[0];
    }

    public function verifySyncRouteInUri()
    {
        $uri = ltrim($this->uri(), "/");
        $routes = $this->list();
        $matches =   array_filter($routes, function ($route) use($uri) {
            $route = preg_replace("/\{[0-9a-zA-Z]+\}/", "[a-zA-Z0-9]+", $route->route);
            $route = ltrim($route, "/");
            $regex = str_replace("/", "\/", $route);
            return preg_match("/^{$regex}$/", $uri);
        });

        if (count($matches) > 1) {
            $routes = array_column($matches, "uri");
            $modules = array_column($matches, "module");
            $files = array_column($matches, "fileOrigin");
            $routesDuplicates = implode(",", $routes);
            $modulesDuplicates = implode(",", $modules);
            $filesDuplicates = implode(",", $files);

            throw new RouteInDuplicityException(
                "Rotas em duplicidade: ({$routesDuplicates}), módulos em duplicidade: ({$modulesDuplicates}), arquivos em duplicidade: ({$filesDuplicates})!",
                500
            );
        }

        return array_values($matches);
    }

    public function getCurrentRoute() : object
    {
        return $this->routeCurrent ?? (object) [];
    }

    public function url()
    {
        return $this->url;
    }

}