<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf;

use Monolog\Logger;
use Shieldforce\FrameSf\Request\Request;

class BootSystem
{
    protected Logger $logger;
    protected Request $request;

    public function start()
    {
        $this->logger = getInstanceLogger();
        $this->request = new Request();
    }
}