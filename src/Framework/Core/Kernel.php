<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Core;

use LapisAngularis\Senshu\Framework\DependencyInjection\CoreDependencyManager;

class Kernel
{
    const NAME = 'OphagaCore';
    const VERSION = '0.0.4';
    const RELEASE_VERSION = 0;
    const FEATURE_VERSION = 0;
    const PATCH_VERSION = 4;
    const VERSION_CODENAME = 'PreAlpha';
    const VERSION_ID = 4;

    protected $env = 'prod';
    protected $dependencyManager;

    public function __construct(string $env)
    {
        $this->env = $env;
    }

    public function getCoreName(): string
    {
        return self::NAME;
    }

    public function getVersion(): string
    {
        return self::VERSION . '-' . self::VERSION_CODENAME;
    }

    public function getVersionId(): int
    {
        return self::VERSION_ID;
    }

    public function getEnvironment(): string
    {
        return $this->env;
    }

    public function getReleaseInfo(): string
    {
        return (string) $this->getCoreName() . ' '
            . $this->getVersion() . ' '
            . $this->getEnvironment() . ', version id: '
            . $this->getVersionId()
        ;
    }

    public function isDevMode(): bool
    {
        return $this->getEnvironment() === 'dev' ? true : false;
    }

    protected function initializeContainers(): self
    {
        $this->dependencyManager = new CoreDependencyManager();
        $this->initializeKernelContainer();
        $this->isDevMode() ? $this->dependencyManager->bootDevServices() : $this->dependencyManager->bootServices();

        return $this;
    }

    protected function initializeKernelContainer(): self
    {
        $this->dependencyManager->setContainer('ophagacore.kernel', function() {
            return $this;
        });

        return $this;
    }

    protected function handleDevErrors(): self
    {
        $errorHandler = $this->dependencyManager->getContainer('ophagacore.error.whoops');
        $prettyPageHandler = $this->dependencyManager->getContainer('ophagacore.error.prettypage');

        if ($this->env !== 'prod') {
            $errorHandler->pushHandler($prettyPageHandler);
        } else {
            $errorHandler->pushHandler(function($e){
                die ('omg you broke the internet :/');
            });
        }

        $errorHandler->register();
        return $this;
    }

    public function createConfig(): self
    {
        $this->dependencyManager->getContainer('ophagacore.config.routes')->createRoutes();

        return $this;
    }

    protected function handle()
    {
        return $this->dependencyManager->getContainer('ophagacore.route.router')->matchRequest();
    }

    public function initialize()
    {
        $this->initializeContainers();
        $this->handleDevErrors();
        $this->createConfig();
        $this->handle();
    }
}