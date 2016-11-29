<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Config;

use LapisAngularis\Senshu\Framework\Config\CoreMainConfig;

class SenshuMainConfig extends CoreMainConfig
{
    public function createConfig()
    {
        $config = [
            'twig.resource.path' => __DIR__.'/../Resources/Templates',
            'twig.compilation.cache' => __DIR__.'/../../../cache/twig'
        ];

        $this->config = $config;
        return $this;
    }

    public function createDevConfig()
    {
        $this->createConfig();
        $this->config['twig.compilation.cache'] = false;

        return $this;
    }
}