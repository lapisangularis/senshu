<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Config;

use LapisAngularis\Senshu\Framework\Config\CoreMainConfig;

class SenshuMainConfig extends CoreMainConfig
{
    public function createConfig(): void
    {
        $config = [
            'twig.resource.path' => __DIR__.'/../Resources/Templates',
            'twig.compilation.cache' => __DIR__.'/../../../cache/twig',
            'template.engine' => 'twig'
        ];

        $this->config = $config;
    }

    public function createDevConfig(): void
    {
        $this->createConfig();
        $this->config['twig.compilation.cache'] = false;
    }
}
