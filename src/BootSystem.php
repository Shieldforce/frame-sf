<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf;

class BootSystem
{
    public static function start()
    {
        register_tick_function('tick_handler');
    }
}