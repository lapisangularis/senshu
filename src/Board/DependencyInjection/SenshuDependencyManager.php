<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\DependencyInjection;

use LapisAngularis\Senshu\Board\Config\SenshuMainConfig;
use LapisAngularis\Senshu\Board\Repository\UserRepository;
use LapisAngularis\Senshu\Framework\DependencyInjection\CoreDependencyManager;
use LapisAngularis\Senshu\Board\Config\RouteMapper;

class SenshuDependencyManager extends CoreDependencyManager
{
    public function bootMainConfig(): void
    {
        $this->setContainer('ophagacore.config.main',
            new SenshuMainConfig($this)
        );
    }

    public function bootServices(): void
    {
        parent::bootServices();

        $this->setContainer('senshu.config.routes',
            new RouteMapper($this->getContainer('ophagacore.route.collection'), $this)
        );

        $this->setContainer('senshu.user.repository',
            new UserRepository(
                $this->getContainer('ophagacore.pdo.wrapper'),
                'LapisAngularis\Senshu\Board\Entity\User'
            )
        );
    }
}
