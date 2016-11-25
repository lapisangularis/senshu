<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Config;

use LapisAngularis\Senshu\Framework\Router\RouteCollection;

class RouteMapper
{
    private $collection;
    private $config = [
        'classBasePath' => 'LapisAngularis\Senshu\Board\Controller'
    ];

    public function __construct(RouteCollection $collection)
    {
        $this->collection = $collection;
    }

    public function createRoutes(): self
    {
        $this->collection->get('/', '\IndexController', 'indexAction', $this->config);
        $this->collection->get('/version', '\IndexController', 'versionAction', $this->config);

        return $this;
    }
}