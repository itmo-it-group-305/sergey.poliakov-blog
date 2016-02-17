<?php

require_once __DIR__ . '/vendor/autoload.php';

use Polyakusha\TikEngine\Http\ParamsContainer;
use Polyakusha\TikEngine\Http\Request;
use Polyakusha\TikEngine\Routing\Router;

//$request = new Request();
//
//var_dump(
//    $request->get()->getInt('id')
//);


//$params = [
//    'int' => '1',
//    'float' => '1.5',
//    'bool' => 'false',
//    'string' => 'Hello',
//    'array' => [
//        '1', '2', '3'
//    ],
//];
//
//$container = new ParamsContainer($params);
//
//foreach ($container as $key => $value)
//{
//    var_dump($key, $value);
//}

//var_dump(
//    $container->getInt('int'),
//    $container->getInt('array', 0, true),
//    $container->getFloat('array', 0, true),
//    $container->getFloat('float')
//);

$pattern = '~{(?P<params>\w+)}~';
$url = '/post/{cat}/{name}';
preg_match_all($pattern, $url, $matches);
var_dump($matches['params']);
$routes = [
    'post_index' => [
        'pattern' => '/',
        'controller' => '\Polyakusha\TikEngine\Controller\PostController:index',
    ],
    'post_show' => [
        'pattern' => '/post/{id}',
        'controller' => '\Polyakusha\TikEngine\Controller\PostController:show',
        'params' => [
            'id' => '\d+',
        ],
    ],
    'post_new' => [
        'pattern' => '/post/new',
        'controller' => '\Polyakusha\TikEngine\Controller\PostController:new',
    ],
    'post_edit' => [
        'pattern' => 'post/{id}/edit',
        'controller' => '\Polyakusha\TikEngine\Controller\PostController:edit',
        'params' => [
            'id' => '\d+',
        ],
    ],
    'test_route' => [
        'pattern' => 'test/{cat}/{id}/{some}',
        'controller' => 'Controller',
        'params' => [
            'id' => '\d+',
            'some' => 'AA[a-z]*?BB',
        ],
    ],
];

$request = new Request();
$router = new Router();

$router->addRoutes($routes);

var_dump(
    $router->dispatch(
        $request->server()->filter('REQUEST_URI')
    )
);


//$router->createUrl('post_show', ['id' => 1,]);
//$router->dispatch('/post/1');
//var_dump(
//    $router
//);