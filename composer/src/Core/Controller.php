<?php

namespace Polyakusha\TikEngine\Core;


use Polyakusha\TikEngine\Http\Response;

abstract class Controller
{
    protected $serviceContainer;

    public static function create($controller)
    {
        if (!$controller || !strpos($controller, ':'))  {
            throw new \InvalidArgumentException(sprintf('Unable to find controller "%s" .', $controller));
        }

        list($classname, $method) = explode(':', $controller, 2);

        $classname .= 'Controller';
        $method .= 'Action';

        if (!class_exists($classname)) {
            throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $classname));
        }

        $callable = [new $classname(), $method];

        if (!is_callable($callable)) {
            throw new \InvalidArgumentException(sprintf('The controller "%s" is not callable.', $callable));
        }

        return $callable;
    }

    protected function get($serviceName)
    {
        return $this->serviceContainer->get($serviceName);
    }

    protected function render($template, array $data = [])
    {
        return new Response(
            $this->get('templater')->render($template, $data)
        );
    }

    public function setContainer($serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
        return $this;
    }
}