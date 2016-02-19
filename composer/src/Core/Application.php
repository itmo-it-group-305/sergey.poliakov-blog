<?php

namespace Polyakusha\TikEngine\Core;

use Polyakusha\TikEngine\Http\ParamsContainer;
use Polyakusha\TikEngine\Http\Response;
use Polyakusha\TikEngine\Http\IHttpException;
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

    public function handleRequest(Request $request)
    {
        try {
            // Router
            $router = $this->serviceContainer->get('router');

            $router = $router->dispatch(
                $request->server()->get('REQUEST_URI')
            );

            $controller =  Controller::create($router->controller);

            if ($controller[0] instanceof Controller) {
                $controller[0]->setContainer($this->serviceContainer);
            }

            $response = call_user_func_array($controller, [$request]);

            if (!$response instanceof Response) {
                throw new \LogicException('The contoller must not returen responce obj');
            }

            return $response;
        } catch (\Exception $e) {
            return $this->exceptionHandler($e);
        }

    }

    protected function exceptionHandler(\Exception $e)
    {
        $response = new Response();

        $code = $e instanceof IHttpExpection ? $e->getCode() : Response::CODE_INTERNAL_SERVER_ERROR;

        $response
            ->setStatusCode($code, $e->getMessage())
            ->setBody($e->getMessage())
            ;

        return $response;
    }

    protected function loadConfig($configPath)
    {
        $config = new ParamsContainer(
            DefaultConfig::getConfig()
        );

        if(is_readable($configPath)) {
            $params = file_get_contents($configPath) ?: '{}';

            if ($params) {
                $params = json_decode($params, true);
            }

            if (is_array($params)) {
                $config->update($params);
            }
        }
        return $config;
    }
}