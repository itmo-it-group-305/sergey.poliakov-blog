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
        var_dump($router);
        // dispatch url
        // create controller
        // execute action
        // return response
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