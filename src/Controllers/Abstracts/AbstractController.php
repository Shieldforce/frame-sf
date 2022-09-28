<?php

namespace Shieldforce\FrameSf\Controllers\Abstracts;

use Shieldforce\FrameSf\Request\Request;

abstract class AbstractController
{
    private Request $request;

    public function __construct()
    {
        $this->request = request();
    }

    public function request()
    {
        return $this->request;
    }

    public function view() : AbstractController
    {
        return $this;
    }
}