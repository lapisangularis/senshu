<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Config;

use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;
use LapisAngularis\Senshu\Framework\Router\RouteCollection;

interface RouteMapperInterface
{
    public function __construct(RouteCollection $collection, DependencyManagerInterface $dependencyManager);
    public function createRoutes();
}
