<?php

namespace Polyakusha\TikEngine\Core;


abstract class DefaultConfig
{
    public static function getConfig()
    {
        return [
            'services' => [
                'db' => [
                    'class' => '\\Polyakusha\\TikEngine\\DataBase\\DB',
                    'host' => null,
                    'port' => null,
                    'username' => null,
                    'password' => null,
                    'dbname' => null,
                    'dbtype' => null,
                ],
                'router' => [
                    'class' => '\\Polyakusha\\TikEngine\\Routing\\Router',
                    'setupMethod' => 'setOptions',
                    'routes' => []
                ],
                'templater' => [
                    'class' => '\\Polyakusha\\TikEngine\\Templating\\TwigTemplateEngine',
                    'templates_dir' => 'templates',
                    'environment_options' => [
                        'cache' => 'cache',
                        'debug' => true,
                    ],
                ],
            ],
        ];
    }
}