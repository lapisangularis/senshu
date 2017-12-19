<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Config;

use LapisAngularis\Senshu\Framework\Config\CoreRouteMapper;
use LapisAngularis\Senshu\Framework\Config\RouteMapperInterface;

class RouteMapper extends CoreRouteMapper implements RouteMapperInterface
{
    protected $config = [
        'classBasePath' => 'LapisAngularis\Senshu\Board\Controller'
    ];

    public function createRoutes(): void
    {
        $this->collection->get('/', 'IndexController', 'indexAction', $this->config);
        $this->collection->get('/test/{text}', 'IndexController', 'testAction', $this->config);
        $this->collection->get('/version', 'IndexController', 'versionAction', $this->config);
    }
}
