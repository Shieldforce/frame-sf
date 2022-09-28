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

    public function view(array $variables = []) : AbstractController
    {
        header("Content-Type:text/html;charset=UTF-8");
        \Shieldforce\FrameSf\Views\View::toReceivePathAndReturnContentFile(
        $this->request->getCurrentRoute()->getCurrentRoute()->controller,
        $this->request->getCurrentRoute()->getCurrentRoute()->name,
        $variables);
        return $this;
    }

    public function json(array $variables = []) : AbstractController
    {
        header("Content-Type:application/json");
        echo json_encode($variables);
        return $this;
    }

    public function response(array $variables = [], array $dataJson = []) : AbstractController
    {
        $headers = request()->getHeaders();
        if(preg_match("/(.*)text\/html(.*)/", $headers["Accept"])) {
            return $this->view($variables);
        }

        if(preg_match("/(.*)application\/json(.*)/", $headers["Content-Type"])) {
            return $this->json($dataJson);
        }
        return $this;
    }
}