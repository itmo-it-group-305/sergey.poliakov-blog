<?php

namespace Polyakusha\TikEngine\Templating;


interface ITemplateEngine
{
    public function render($template, array $data = []);
}