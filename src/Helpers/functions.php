<?php

declare(strict_types=1);

use Shieldforce\FrameSf\Enums\ChannelsLogsEnum;
use Shieldforce\FrameSf\Log\LogCustomImplement;

function config_init()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('error_reporting', E_ALL);
    error_reporting(E_ALL);

    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', '-1');
    date_default_timezone_set("America/Sao_Paulo");
    if(getenv("APP_ENV")=="local")
    {
        setlocale(LC_TIME, 'ptb.UTF-8');
    }
    if(getenv("APP_ENV")=="production")
    {
        setlocale(LC_TIME, 'pt_BR.utf8');
    }
}

set_error_handler('warning_handler', E_WARNING);
function warning_handler($code, $message, $file, $line)
{
    $array = [
        "code" => $code,
        "message" => $message,
        "file" => $file,
        "line" => $line,
    ];
    LogCustomImplement::warning(
        ChannelsLogsEnum::LogInternalHelpersCore,
        $array["message"],
        $array
    );
}

function exceptionLogArray($exception)
{
    return [
        "code" => $exception->getCode(),
        "message" => $exception->getMessage(),
        "line" => $exception->getLine(),
        "file" => $exception->getFile(),
        "trace" => $exception->getTrace(),
        "trance_string" => $exception->getTraceAsString(),
        "previous" => $exception->getPrevious(),
    ];
}

function emailsToSendgridChannels($channel)
{
    $return = [
        "LogBootSystem" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
        "LogInternalReneric" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
        "LogExternalPackage" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
        "LogInternalHelpersCore" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
        "LogInternalMethodCore" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
        "LogInternalRouteCore" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
        "LogInternalPageNotFoundCore" => [
            ["mail" => "shieldforce2@gmail.com" , "name" => "Alexandre Ferreira"],
            ["mail" => "alexandrefn7@gmail.com" , "name" => "Alexandre Ferreira"],
        ],
    ];
    return $return[$channel] ?? [];
}

function getInstanceLogger() : \Monolog\Logger
{
    $instance = \Shieldforce\FrameSf\Log\StartSingletonLogger::getInstance();
    return $instance->getLogger();
}

function dd($content, $__FILE__=__FILE__, $__LINE__=__LINE__)
{
    $content = json_encode($content, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    $content = str_replace([
        ": ",
        "{",
        "}",
        "(",
        ")",
        '"',
        "[",
        "]",
    ], [
        "<span style='color: cornflowerblue;'>: </span>",
        "<span style='color: yellow;'>{</span>",
        "<span style='color: yellow;'>}</span>",
        "<span style='color: blueviolet;'>(</span>",
        "<span style='color: blueviolet;'>)</span>",
        "<span style='color: red;'>\"</span>",
        "<span style='color: cornflowerblue;'>[</span>",
        "<span style='color: cornflowerblue;'>]</span>",
    ], $content);
    echo "<pre style='background: black;color: forestgreen;padding: 20px;'>";
    echo "<div style='border: 1px dashed white;height: 92vh;padding: 5px;'>";
    $nameSystem = getenv("APP_NAME");
    $date = date("d/m/Y H:i:s");
    echo "<h1 style='text-align: center;color: greenyellow;border: 1px dashed white;margin: 5px 5px 5px 5px;padding: 5px;'>Debug {$nameSystem} - <span style='font-size: 12pt;color: cornflowerblue;'>Data Local: {$date}</span></h1>";
    echo "<div style='padding: 10px;overflow-y: scroll;height: 80vh;'>";
    print_r($content);
    echo "</div>";
    echo "</div>";
    echo "<div style='position:fixed;width:95.4%;background:black;color: greenyellow;border: 1px dashed white;margin: -40px 10px 10px 10px;padding: 5px;'>";
    echo "<div style='width: 50%;float: left;position: relative;'><span style='font-size: 12pt;color: greenyellow;text-align: left;'>Arquivo: <span style='color: red;'>{$__FILE__}</span></span></div>";
    echo "<div style='width: 5%;float: left;position: relative;'><span style='font-size: 12pt;color: white;'> | </span></div>";
    echo "<div style='width: 10%;float: left;position: relative;'><span style='font-size: 12pt;color: greenyellow;text-align: right;'>Linha: <span style='color: red;'>{$__LINE__}</span></span></div>";
    echo "<div style='width: 5%;float: left;position: relative;'><span style='font-size: 12pt;color: white;'> | </span></div>";
    echo "<div style='width: 10%;float: left;position: relative;'><span style='font-size: 12pt;color: greenyellow;text-align: right;'>Usuário: <span style='color: red;'>-</span></span></div>";
    echo "</div>";
    echo "</pre>";
    die;
}

function getOS()
{
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
        '/windows nt 10/i'     =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }
    }
    return $os_platform;
}

function getBrowser() {
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    $browser        =   "Unknown Browser";
    $browser_array  =   array(
        '/msie/i'       =>  'Internet Explorer',
        '/firefox/i'    =>  'Firefox',
        '/safari/i'     =>  'Safari',
        '/chrome/i'     =>  'Chrome',
        '/edge/i'       =>  'Edge',
        '/opera/i'      =>  'Opera',
        '/netscape/i'   =>  'Netscape',
        '/maxthon/i'    =>  'Maxthon',
        '/konqueror/i'  =>  'Konqueror',
        '/mobile/i'     =>  'Handheld Browser'
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }
    }
    return $browser;
}

function request()
{
    return \Shieldforce\FrameSf\Request\Request::getInstance();
}

function view(\Shieldforce\FrameSf\Controllers\Abstracts\AbstractController $controller, string $name, array $variables = [])
{
    return \Shieldforce\FrameSf\Views\View::toReceivePathAndReturnContentFile($controller, $name, $variables);
}

function config($scope)
{
    $array = \Shieldforce\FrameSf\ManipulationFilesAndDirs\ManipulationFilesAndDirReturnArray::read("../config");
    $arrayFilesRequire = [];
    foreach ($array as $file) {
        $arrayFilesRequire[str_replace([".php"], [""], $file["nameFile"])] = require($file["pathFile"]);
    }
    return (object) $arrayFilesRequire[$scope];
}

