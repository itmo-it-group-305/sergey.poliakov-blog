<?php

namespace Polyakusha\TikEngine\Templating;

class TwigTemplateEngine implements ITemplateEngine
{
    protected $enviroment;
    protected $loader;

    public function __construct(array $config)
    {
        $this->loader = new \Twig_Loader_Filesystem($config['templates_dir']);

        $this->enviroment = new \Twig_Environment($this->loader, $config['enviroment_options']);
    }

    public function render($template, array $data = [])
    {
        return $this->enviroment->render($template, $data);
    }
}