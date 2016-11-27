<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Service\Template;

use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigService
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function loadTemplateEngine()
    {
        $loader = new Twig_Loader_Filesystem($this->config['twig.resource.path']);
        $twig = new Twig_Environment($loader, array(
            'cache' => $this->config['twig.compilation.cache'],
        ));

        return $twig;
    }
}