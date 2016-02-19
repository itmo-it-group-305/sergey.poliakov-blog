<?php

namespace Polyakusha\TikEngine\Http;

class Response
{
    const CODE_OK = 200;

    const STATUS_TEXT = [
        self::CODE_OK => 'OK'
    ];


    protected $body;
    protected $headers = [];
    protected $protocolVersion;
    protected $statusCode = self::CODE_OK;
    protected $statusText;

    public function __construct($body = '', $statusCode = self::CODE_OK, array $headers = [])
    {
        $this
            ->setBody($body)
            ->setStatusCode($statusCode)
            ->setHeaders($headers);
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