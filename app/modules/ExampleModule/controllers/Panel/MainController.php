<?php

namespace App\modules\ExampleModule\controllers\Panel;

use Shieldforce\FrameSf\Controllers\Abstracts\AbstractController;

class MainController extends AbstractController
{
    public function dashboard()
    {
        // Resposta para view!
        return $this->view(["title"=>"Essa retorna para uma view! (Dashboard)"]);
    }
}