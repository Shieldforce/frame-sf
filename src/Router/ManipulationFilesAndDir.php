<?php

namespace Shieldforce\FrameSf\Router;

class ManipulationFilesAndDir
{

    private static array $pathsAccepts;

    private static function addPathAccepts($pathAccept)
    {
        self::$pathsAccepts[] = $pathAccept;
    }

    public function getPathAccepts()
    {
        return self::$pathsAccepts;
    }

    public static function readRoutes(string $path)
    {
        $listDiretoriesModules = array_diff(
            scandir($path),
            ['.', '..']
        );
        foreach($listDiretoriesModules as $diretoryOrFileModule) {
            $pathModules = $path."/".$diretoryOrFileModule;
            $listDiretoriesRoutes = array_diff(
                scandir($pathModules),
                ['.', '..']
            );
            foreach ($listDiretoriesRoutes as $listDiretoryRoute) {
                $pathRoutes = $path."/".$diretoryOrFileModule."/".$listDiretoryRoute;
                if($listDiretoryRoute=="routes") {
                    self::read($pathRoutes);
                }
            }
        }
    }

    public static function read(string $path)
    {
        $listDiretories = array_diff(
            scandir($path),
            ['.', '..']
        );
        foreach($listDiretories as $diretoryOrFile) {
            if(is_file($path."/".$diretoryOrFile)) {
                self::addPathAccepts($path);
                include $path."/".$diretoryOrFile;
            }
            if(is_dir($path."/".$diretoryOrFile)) {
                self::read($path."/".$diretoryOrFile);
            }
        }
    }
}