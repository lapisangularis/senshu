<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\DependencyInjection;

use LapisAngularis\Senshu\Framework\DependencyInjection\CoreDependencyManager;
use LapisAngularis\Senshu\Board\Config\RouteMapper;

class SenshuDependencyManager extends CoreDependencyManager
{
    public function bootServices(): self
    {
        parent::bootServices();

        $this->setContainer('senshu.config.routes',
            new RouteMapper($this->getContainer('ophagacore.route.collection'), $this)
        );

        return $this;
    }
}
