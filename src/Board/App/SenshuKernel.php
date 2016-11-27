<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\App;

use LapisAngularis\Senshu\Board\DependencyInjection\SenshuDependencyManager;
use LapisAngularis\Senshu\Framework\Core\Kernel;

class SenshuKernel extends Kernel
{
    protected $dependencyManager;

    protected function initializeDependencyManager()
    {
        $this->dependencyManager = new SenshuDependencyManager();

        return $this;
    }

    protected function createRoutes()
    {
        $this->dependencyManager->getContainer('senshu.config.routes')->createRoutes();

        return $this;
    }
}
