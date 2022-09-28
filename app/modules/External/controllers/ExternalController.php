<?php

namespace App\modules\External\controllers;

use Shieldforce\FrameSf\Controllers\Abstracts\AbstractController;

class ExternalController extends AbstractController
{
    public function index()
    {
        return view($this, "index");
    }

    public function show()
    {
        return view($this, "show", ["nome" => "Alexandre", "idade" => 40]);
    }

}