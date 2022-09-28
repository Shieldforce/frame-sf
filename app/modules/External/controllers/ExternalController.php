<?php

namespace App\modules\External\controllers;

use Shieldforce\FrameSf\Controllers\Abstracts\AbstractController;

class ExternalController extends AbstractController
{
    public function list()
    {
        echo "list";
    }

    public function show()
    {
        return view($this, "teste", ["nome" => "Alexandre", "idade" => 40]);
    }

}