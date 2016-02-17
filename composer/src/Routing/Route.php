<?php

namespace Polyakusha\TikEngine\Routing;

class Route
{
    protected $compileRoute;
    protected $controller;
    protected $pattern;
    protected $restrictions = [];

    public function __construct($pattern, $controller, array $restrictions = [])
    {
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->restrictions = $restrictions;
    }

    public function compile()
    {
        if ($this->compileRoute){
            return $this->compileRoute;
        }
        $pairs = array_fill_keys($this->getParamNames(), '\w+');
        $pairs = array_merge($pairs, $this->getRestrictions());

        $replacePairs = [];

        foreach ($pairs as $name => $rule) {
            $replacePairs["{{$name}}"] = "(?P<$name>$rule)";
        }

        $this->compileRoute = '~^' . strtr($this->getPattern(), $replacePairs) . '$~i';

        return $this->compileRoute;
    }

    public function getParamNames()
    {
        preg_match_all('~{(?P<names>\w+)}~', $this->getPattern(), $matches);
        return $matches['names'];
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function getRestrictions()
    {
        return $this->restrictions;
    }
}