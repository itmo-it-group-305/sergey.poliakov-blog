<?php

namespace Polyakusha\TikEngine\Core;

use Polyakusha\TikEngine\Routing\InvalidRouteException;

class ServiceContainer
{
    protected $config;
    protected $services = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function createService($name)
    {
        if (isset($this->services[$name])) {
            throw new \LogicException(sprintf('Service with name "%s" already exist', $name));
        }

        if (!isset($this->config[$name])) {
            throw new \InvalidArgumentException(sprintf('Service with the name "%s" does not exist', $name));
        }

        $config = $this->config[$name];

        if (!isset($config['class'])) {
            throw new \InvalidArgumentException(sprintf('%s" is not class name', $name));
        }

        $classname = $config['class'];
        unset($config['class']);

        if (!class_exists($classname)) {
            throw new \InvalidArgumentException(srpintf('Class "%s" does not exist', $classname));
        }

        if (isset($config['setupMethod'])) {
            $setup = $config['setupMethod'];
            unset($config['setupMethod']);

            $service = new $classname();
            $service->$setup($config);
        } else {
            $service = new $classname($config);
        }

        $this->services[$name] = $service;

        return $service;
    }

    public function get($name)
    {
        try {
            if (!isset($this->services[$name])) {
                throw new \InvalidArgumentException(sprintf('service with "%s" not exist', $name));
            }

            return $this->services[$name];
        } catch (\InvalidArgumentException $e) {
            return $this->createService($name);
        }
    }
}