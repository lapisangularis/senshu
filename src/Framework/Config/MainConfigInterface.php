<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Config;

use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;

interface MainConfigInterface
{
    public function __construct(DependencyManagerInterface $dependencyManager);
    public function getConfigs(): array;
    public function getConfig(string $name);
    public function createConfig();
}