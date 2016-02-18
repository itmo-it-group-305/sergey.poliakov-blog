<?php

namespace Polyakusha\TikEngine\Core;


abstract class Controller
{
    public static function create($controller)
    {
        if (!$controller || strpos($controller, ':'))  {
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
}