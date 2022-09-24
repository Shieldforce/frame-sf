<?php

declare(strict_types=1);

namespace Shieldforce\FrameSf;

use Shieldforce\FrameSf\Request\Request;

class BootSystem
{
    public function start()
    {
        $request = Request::getInstance();
        dd($request->all(), __FILE__, __LINE__);
    }
}