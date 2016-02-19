<?php

//use Polyakusha\TikEngine\Http\ParamsContainer;
//use Polyakusha\TikEngine\Http\Request;
//use Polyakusha\TikEngine\Routing\Router;
//use Polyakusha\TikEngine\Core\Application;
//
//require_once __DIR__ . '/vendor/autoload.php';

//$routes = [
//    'post_index' => [
//        'pattern' => '/blog/composer/',
//        'controller' => '\Polyakusha\MegaBlog\Controller\PostController:index',
//    ],
//    'post_show' => [
//        'pattern' => '/blog/composer/post/{id}',
//        'controller' => '\Polyakusha\MegaBlog\Controller\PostController:show',
//        'params' => [
//            'id' => '\d+',
//        ],
//    ],
//    'post_new' => [
//        'pattern' => '/blog/composer/post/new',
//        'controller' => '\Polyakusha\MegaBlog\Controller\PostController:new',
//    ],
//    'post_edit' => [
//        'pattern' => '/blog/composer/post/{id}/edit',
//        'controller' => '\Polyakusha\MegaBlog\Controller\PostController:edit',
//        'params' => [
//            'id' => '\d+',
//        ],
//    ],
//    'test_route' => [
//        'pattern' => '/blog/composer/test/{cat}/{id}/{some}',
//        'controller' => 'Controller',
//        'params' => [
//            'id' => '\d+',
//            'some' => 'AA[a-z]*?BB',
//        ],
//    ],
//];

//$request = new Request();
//
//$router = new Router();
//$router->addRoutes($routes);
//
//var_dump(
//    $router->dispatch(
//        $request->server()->filter('REQUEST_URI')
//    )
//);
//
//var_dump(
//    $router->createUrl('post_show', [
//        'id' => 1,
//    ])
//);

use Polyakusha\TikEngine\Http\Request;

require_once __DIR__ . '/vendor/autoload.php';

use Polyakusha\TikEngine\Core\Application;

$request = new Request();

$app = new Application(__DIR__ . '/config.json');
$app->handeRequest($request);

////$request = new Request();
////
//var_dump(
//    $request->get()->getInt('id')
//);
//
//
////$params = [
////    'int' => '1',
////    'float' => '1.5',
////    'bool' => 'false',
////    'string' => 'Hello',
////    'array' => [
////        '1', '2', '3'
////    ],
////];
////
////$container = new ParamsContainer($params);
////
////foreach ($container as $key => $value)
////{
////    var_dump($key, $value);
////}
//
////var_dump(
////    $container->getInt('int'),
////    $container->getInt('array', 0, true),
////    $container->getFloat('array', 0, true),
////    $container->getFloat('float')
////);
//
//$pattern = '~{(?P<params>\w+)}~';
//$url = '/post/{cat}/{name}';
//preg_match_all($pattern, $url, $matches);
//// matches - массив, куда попадают совпадения
////var_dump($matches['params']);
//

//
//$request = new Request();
//$router = new Router();
//
//$router->addRoutes($routes);
//

//
//
////$router->createUrl('post_show', ['id' => 1,]);
////$router->dispatch('/post/1');
////var_dump(
////    $router
////);