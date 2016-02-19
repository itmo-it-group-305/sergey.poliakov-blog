<?php

namespace Polyakusha\TikEngine\Http;

class Response
{
    const CODE_OK = 200;
    const CODE_INTERNAL_SERVER_ERROR = 500;

    const STATUS_TEXT = [
        self::CODE_OK => 'OK',
        self::CODE_INTERNAL_SERVER_ERROR => 'Internal Server Error'
    ];


    protected $body;
    protected $headers = [];
    protected $protocolVersion = '1.1';
    protected $statusCode = self::CODE_OK;
    protected $statusText;

    public function __construct($body = '', $statusCode = self::CODE_OK, array $headers = [])
    {
        $this
            ->setBody($body)
            ->setStatusCode($statusCode)
            ->setHeaders($headers);
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function processRequest(Request $request)
    {
        list($protocol, $version) = explode ('/', $request->server()->get('SERVER_PROTOCOL'), 2);
        $this->setProtocolVersion($version);
        return $this;
    }

    public function send()
    {
        $this->sendHeaders()->sendBody();
        return $this;
    }

    protected function sendBody()
    {
        echo $this->getBody();
        return $this;
    }

    protected function sendHeaders()
    {
        if (headers_sent()) {
            return $this;
        }

        foreach ($this->getHeaders() as $name => $value) {
            header(sprintf('%s: %s', $name, $value), false, $this->getStatusCode());
        }

        header(sprintf('HTTP/%s %s %s', $this->getProtocolVersion(), $this->getStatusCode(), $this->statusText), true, $this->getStatusCode());

        return $this;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function setProtocolVersion($protocolVersion) {
        $this->protocolVersion = $protocolVersion;
        return $this;
    }

    public function setStatusCode($statusCode, $statusText = '')
    {
        $statusCode = (int) $statusCode;

        if (!$statusText) {
            $statusText = array_key_exists($statusCode, self::STATUS_TEXT)
                ? self::STATUS_TEXT[$statusCode] : '';
        }

        $this->statusCode = $statusCode;
        $this->statusText = $statusText;

        return $this;
    }
}