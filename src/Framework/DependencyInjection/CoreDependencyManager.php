<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\DependencyInjection;

use LapisAngularis\Senshu\Framework\Config\CoreRouteMapper;
use LapisAngularis\Senshu\Framework\Config\CoreMainConfig;
use LapisAngularis\Senshu\Framework\Http\HttpRequest;
use LapisAngularis\Senshu\Framework\Nexus\Middleware\TemplateEngineMiddleware;
use LapisAngularis\Senshu\Framework\Nexus\TemplateEngine\CoreTemplateUtils;
use LapisAngularis\Senshu\Framework\Router\RouteCollection;
use LapisAngularis\Senshu\Framework\Router\Router;
use LapisAngularis\Senshu\Framework\Service\Template\TemplateEngine;
use LapisAngularis\Senshu\Framework\Service\Template\TwigService;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class CoreDependencyManager implements DependencyManagerInterface
{
    protected $services = [];

    public function getContainer(string $name)
    {
        return $this->services[$name];
    }

    public function getContainers(): iterable
    {
        return $this->services;
    }

    public function setContainer(string $name, $service): void
    {
       $this->services[$name] = $service;
    }

    public function bootMainConfig(): void
    {
        $this->setContainer('ophagacore.config.main',
            new CoreMainConfig($this)
        );
    }

    public function bootServices(): void
    {
        $this->setContainer('ophagacore.error.whoops',
            new Run()
        );

        $this->setContainer('ophagacore.error.prettypage',
            new PrettyPageHandler()
        );

        $this->setContainer('ophagacore.http.request',
            new HttpRequest($_GET, $_POST, $_COOKIE, $_SERVER)
        );

        $this->setContainer('ophagacore.route.collection',
            new RouteCollection()
        );

        $this->setContainer('ophagacore.config.routes',
            new CoreRouteMapper($this->getContainer('ophagacore.route.collection'), $this)
        );

        $this->setContainer('ophagacore.route.router',
            new Router(
                $this->getContainer('ophagacore.route.collection'),
                $this->getContainer('ophagacore.http.request')
            )
        );

        $this->setContainer('ophagacore.templates',
            new TemplateEngine($this->getContainer('ophagacore.config.main'), [
                'twig' => new TwigService($this->getContainer('ophagacore.config.main'))
            ])
        );

        $this->setContainer('ophagacore.utils.templates',
            new CoreTemplateUtils($this)
        );

        $this->setContainer('ophagacore.middleware.templates',
            new TemplateEngineMiddleware(
                $this->getContainer('ophagacore.config.main'),
                $this->getContainer('ophagacore.utils.templates'),
                $this->getContainer('ophagacore.templates')
            )
        );
    }

    public function bootDevServices(): void
    {
        $this->bootServices();
    }
}
