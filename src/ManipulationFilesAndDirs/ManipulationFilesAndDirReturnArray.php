<?php

namespace Shieldforce\FrameSf\ManipulationFilesAndDirs;

class ManipulationFilesAndDirReturnArray
{
    public static function read(string $path)
    {
        $arrayFiles = [];
        $listDiretories = array_diff(
            scandir($path),
            ['.', '..']
        );
        foreach($listDiretories as $diretoryOrFile) {
            if(is_file($path."/".$diretoryOrFile)) {
                $arrayFiles[] = [
                    "nameFile" => $diretoryOrFile,
                    "pathFile" => $path."/".$diretoryOrFile
                ];
            }
            if(is_dir($path."/".$diretoryOrFile)) {
                self::read($path."/".$diretoryOrFile);
            }
        }
        return $arrayFiles;
    }
}