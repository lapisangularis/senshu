<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Config;

use LapisAngularis\Senshu\Framework\Config\RouteMapperInterface;
use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;
use LapisAngularis\Senshu\Framework\Router\RouteCollection;

class RouteMapper implements RouteMapperInterface
{
    private $collection;
    private $config = [
        'classBasePath' => 'LapisAngularis\Senshu\Board\Controller'
    ];

    public function __construct(RouteCollection $collection, DependencyManagerInterface $dependencyManager)
    {
        $this->collection = $collection;
        $this->config['dependencyManager'] = $dependencyManager;
    }

    public function createRoutes(): void
    {
        $this->collection->get('/', 'IndexController', 'indexAction', $this->config);
        $this->collection->get('/test/{text}', 'IndexController', 'testAction', $this->config);
        $this->collection->get('/version', 'IndexController', 'versionAction', $this->config);
    }
}
