<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Config;

use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;
use LapisAngularis\Senshu\Framework\Router\RouteCollection;

class CoreRouteMapper implements RouteMapperInterface
{
    private $collection;
    private $config = [];

    public function __construct(RouteCollection $collection, DependencyManagerInterface $dependencyManager)
    {
        $this->collection = $collection;
        $this->config['dependencyManager'] = $dependencyManager;
    }

    public function createRoutes(): self
    {
        return $this;
    }
}
