<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\App;

use LapisAngularis\Senshu\Board\DependencyInjection\SenshuDependencyManager;
use LapisAngularis\Senshu\Framework\Core\Kernel;

class SenshuKernel extends Kernel
{
    protected $dependencyManager;

    protected function initializeContainers()
    {
        $this->dependencyManager = new SenshuDependencyManager();
        $this->initializeKernelContainer();
        $this->isDevMode() ? $this->dependencyManager->bootDevServices() : $this->dependencyManager->bootServices();

        return $this;
    }

    protected function createConfig()
    {
        $this->dependencyManager->getContainer('senshu.config.routes')->createRoutes();

        return $this;
    }
}
