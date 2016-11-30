<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Service\Template;

use LapisAngularis\Senshu\Framework\Config\MainConfigInterface;
use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigService implements TemplateInterface
{
    protected $config;
    protected $twig;

    public function __construct(MainConfigInterface $config)
    {
        $this->config = $config->getConfigs();
    }

    public function loadTemplateEngine(): self
    {
        $loader = new Twig_Loader_Filesystem($this->config['twig.resource.path']);
        $this->twig = new Twig_Environment($loader, array(
            'cache' => $this->config['twig.compilation.cache'],
        ));

        return $this;
    }

    public function getEngine(): Twig_Environment
    {
        return $this->twig;
    }

    public function render(string $template, array $variables): string
    {
        return $this->twig->render($template, $variables);
    }
}
