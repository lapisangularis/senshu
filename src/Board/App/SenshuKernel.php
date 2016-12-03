<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\App;

use LapisAngularis\Senshu\Board\DependencyInjection\SenshuDependencyManager;
use LapisAngularis\Senshu\Framework\Core\Kernel;

class SenshuKernel extends Kernel
{
    protected $dependencyManager;

    protected function initializeDependencyManager(): void
    {
        $this->dependencyManager = new SenshuDependencyManager();
    }

    protected function createRoutes(): void
    {
        $this->dependencyManager->getContainer('senshu.config.routes')->createRoutes();
    }
}
