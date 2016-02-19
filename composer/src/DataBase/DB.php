<?php

namespace Polyakusha\TikEngine\DataBase;

class DB extends \PDO
{
    public function __construct(array $config)
    {
        $dsn = sprintf('%s:host=%s;dbname=%s', $config['dbtype'], $config['dbhost'], $config['dbname']);
        $username = isset($config['username']) ? $config['username'] : '';
        $password = isset($config['password']) ? $config['password'] : '';
        parent::__construct($dsn, $username, $password);
    }
}