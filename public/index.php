<?php

use Dotenv\Dotenv;
use Shieldforce\FrameSf\BootSystem;
use Shieldforce\FrameSf\Errors\Logs\SaveLogsErrors;

/**
 * Habilitando erros no PHP
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {

    /**
     * Iniciando uso do Autoload do composer
     */
    require "../vendor/autoload.php";

    /**
     * Iniciando possibilidade de usar variáveis de ambiente!
     */
    $dotenv = Dotenv::createUnsafeImmutable("../"); $dotenv->load();

    /**
     * Aonde chamado a função register_tick_function('tick_handler');
     * será executado está função!
     */
    declare(ticks=1);
    function tick_handler()
    {
        //
    }

    /**
     * Startando o sistema!
     */
    BootSystem::start();

} catch (\Throwable $exception) {
    SaveLogsErrors::execute($exception);
}
