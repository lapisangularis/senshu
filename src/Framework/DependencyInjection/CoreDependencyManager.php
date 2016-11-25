<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\DependencyInjection;

use LapisAngularis\Senshu\Framework\Http\HttpRequest;
use LapisAngularis\Senshu\Framework\Router\RouteCollection;
use LapisAngularis\Senshu\Board\Config\RouteMapper;
use LapisAngularis\Senshu\Framework\Router\Router;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class CoreDependencyManager implements DependencyManagerInterface
{
    private $services = [];

    public function getContainer(string $name)
    {
        return $this->services[$name];
    }

    public function getContainers(): array
    {
        return $this->services;
    }

    public function setContainer(string $name, $service): self
    {
       $this->services[$name] = $service;

        return $this;
    }

    public function bootServices(): self
    {
        $this->setContainer('ophagacore.http.request',
            new HttpRequest($_GET, $_POST, $_COOKIE, $_SERVER)
        );

        $this->setContainer('ophagacore.route.collection',
            new RouteCollection()
        );

        $this->setContainer('ophagacore.config.routes',
            new RouteMapper($this->getContainer('ophagacore.route.collection'))
        );

        $this->setContainer('ophagacore.route.router',
            new Router(
                $this->getContainer('ophagacore.route.collection'),
                $this->getContainer('ophagacore.http.request')
            )
        );

        $this->setContainer('ophagacore.error.whoops',
            new Run()
        );

        $this->setContainer('ophagacore.error.prettypage',
            new PrettyPageHandler()
        );

        return $this;
    }

    public function bootDevServices(): self
    {
        $this->bootServices();

        return $this;
    }
}