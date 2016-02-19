<?php

namespace Polyakusha\TikEngine\Http;

class Request
{
    protected $cookieVars;
    protected $envVars;
    protected $filesVars;
    protected $getVars;
    protected $params;
    protected $postVars;
    protected $serverVars;

    public function __construct(array $params = [])
    {
        $this->cookieVars = new ParamsContainer($_COOKIE);
        $this->envVars = new ParamsContainer($_ENV);
        $this->filesVars = new ParamsContainer($_FILES);
        $this->getVars = new ParamsContainer($_GET);
        $this->params = new ParamsContainer($_POST);
        $this->postVars = new ParamsContainer($params);
        $this->serverVars = new ParamsContainer($_SERVER);
    }

    public function cookie()
    {
        return $this->cookieVars;
    }

    public function env()
    {
        return $this->filesVars;
    }

    public function get()
    {
        return $this->getVars;
    }

    public function post()
    {
        return $this->postVars;
    }

    public function params()
    {
        return $this->requestParams;
    }

    public function server()
    {
        return $this->serverVars;
    }

    public function getRequestUri()
    {
        return $this->server()->get('REQUEST_URI');
    }
}