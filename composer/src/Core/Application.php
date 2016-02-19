<?php

namespace Polyakusha\TikEngine\Core;

use Polyakusha\TikEngine\Http\ParamsContainer;
use Polyakusha\TikEngine\Http\Request;

class Application
{
    protected $config;
    protected $serviceContainer;

    public function __construct($configPath)
    {
        $this->config = $this->loadConfig($configPath);
        $this->serviceContainer = new ServiceContainer(
            $this->config->get('services', [], true)
        );
    }

    public function handeRequest(Request $request)
    {
        // Router
        $router = $this->serviceContainer->get('router');

        $router = $router->dispatch(
            $request->server()->get('REQUEST_URI')
        );

        $controller =  Controller::create($router->controller);

        $response = call_user_func_array($controller, [$request]);

        return $response;
    }

    protected function loadConfig($configPath)
    {
        $config = new ParamsContainer();

        if(is_readable($configPath)) {
            $config->update(
                json_decode(file_get_contents($configPath), true)
            );
        }

        return $config;
    }
}