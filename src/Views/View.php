<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf\Views;

use Shieldforce\FrameSf\Controllers\Abstracts\AbstractController;

class View
{
    public static function toReceivePathAndReturnContentFile(AbstractController $controller, string $name, array $variables = [])
    {
        $name = ltrim($name, "/");
        $name = str_replace(["."], ["/"], $name);
        $fileOrigin = request()->getCurrentRoute()->getCurrentRoute()->fileOrigin;
        $pattern = "/\/routes(.*)/";
        preg_match($pattern, $fileOrigin, $matches);
        $pathModule = str_replace($matches[0], "", $fileOrigin)."/views/";
        $pathFileView = $pathModule.$name.".phtml";
        foreach ($variables as $key => $v) {
            $$key = $v;
        }
        include($pathFileView);
        return $controller;
    }
}