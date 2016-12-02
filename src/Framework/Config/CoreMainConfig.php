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

    public function getConfig(string $name): string
    {
        return $this->config[$name];
    }

    public function createConfig(): void
    {
        $config = [];

        $this->config = $config;
    }

    public function createDevConfig(): void
    {
        $this->createConfig();
    }
}
