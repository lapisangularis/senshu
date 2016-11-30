<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Service\Template;

use LapisAngularis\Senshu\Framework\Config\MainConfigInterface;
use LapisAngularis\Senshu\Framework\Service\CompositeInterface;

class TemplateEngine implements CompositeInterface
{
    protected $templateEngines = [];
    protected $config;

    public function __construct(MainConfigInterface $config, array $templateEngines = [])
    {
        $this->config = $config;
        $this->templateEngines = $templateEngines;
        $this->boot($this->config->getConfig('template.engine'));
    }

    public function boot(string $name): self
    {
        if (array_key_exists($name, $this->templateEngines)) {
            $this->templateEngines[$this->config->getConfig('template.engine')]->loadTemplateEngine();
        }

        return $this;
    }

    public function add(TemplateInterface $templateEngine, string $name): self
    {
        $this->templateEngines[$name] = new $templateEngine($this->config);

        return $this;
    }

    public function getEngine(string $name): TemplateInterface
    {
        if (array_key_exists($name, $this->templateEngines)) {
            return $this->templateEngines[$name];
        }

        return $this->templateEngines['twig'];
    }
}
