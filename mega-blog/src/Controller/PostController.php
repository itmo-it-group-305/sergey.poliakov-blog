<?php

namespace Polyakusha\TikEngine\Test;

use Polyakusha\TikEngine\Core\Controller;
use Polyakusha\TikEngine\Http\Response;

class PostController extends Controller
{
    public function indexAction(...$args)
    {
        var_dump($this->get('templater'));
//        return $this->render('post/show.html.twig', [
//        'posts' => [],
//        ]);
    }

    public function showAction(...$args)
    {
        echo 'Показать запись по уникальному ID';
    }

    public function newAction(...$args)
    {
        echo 'Добавить новую запись в блог';
    }

    public function editAction(...$args)
    {
        return new Response('Отредактировать запись с указанным ID');
    }
}