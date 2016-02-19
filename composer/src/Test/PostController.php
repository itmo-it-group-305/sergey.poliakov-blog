<?php

namespace Polyakusha\TikEngine\Test;

class PostController
{
    public function indexAction(...$args)
    {
        echo 'Показать все записи в блоге';
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
        echo 'Отредактировать запись с указанным ID';
    }
}