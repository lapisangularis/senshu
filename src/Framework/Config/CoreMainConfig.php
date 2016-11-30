<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Config;

use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;

class CoreMainConfig implements MainConfigInterface
{
    protected $dependencyManager;
    protected $config = [];

    public function __construct(DependencyManagerInterface $dependencyManager)
    {
        $this->dependencyManager = $dependencyManager;
    }

    public function getConfigs(): array
    {
        return $this->config;
    }

    public function getConfig(string $name)
    {
        return $this->config[$name];
    }

    public function createConfig()
    {
        $config = [];

        $this->config = $config;
        return $this;
    }

    public function createDevConfig()
    {
        $this->createConfig();

        return $this;
    }
}