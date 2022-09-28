<?php

namespace Shieldforce\FrameSf\Modules;

class CaptureModules
{
    private static array $modules = [];

    public static function addModule($modules)
    {
        $modules = str_replace(["../app/modules//", "/routes"], ["", ""], $modules);
        self::$modules = array_values(array_unique($modules));
    }

    public function getModules()
    {
        return self::$modules;
    }
}