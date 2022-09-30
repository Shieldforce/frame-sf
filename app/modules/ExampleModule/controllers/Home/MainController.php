<?php

declare(strict_types=1);

namespace App\modules\ExampleModule\controllers\Home;

use Shieldforce\FrameSf\Controllers\Abstracts\AbstractController;

class MainController extends AbstractController
{
    public function index()
    {
        // Resposta para view!
        return $this->view(["title"=>"Essa retorna para uma view!"]);
    }

    public function about()
    {
        // Resposta para API!
        return $this->json(["title"=>"Essa retorna para uma API"]);
    }

    public function apiOrHtml()
    {
        // Resposta hibrida tanto para view ou para API!
        return $this->response(
            // Esse primeiro array entrega as variáveis para a view!
            ["titleHtml" => "Essa retorna para a view!"],

            // Esse segundo array entrega o resultado para a API!
            ["titleApi"=>"Essa retorna para API"]
        );
    }

}