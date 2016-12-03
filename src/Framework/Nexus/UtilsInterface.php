<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Nexus;

use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;

interface UtilsInterface
{
    public function __construct(DependencyManagerInterface $dependencyManager);
}
