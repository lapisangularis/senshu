<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Nexus\TemplateEngine;

use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;
use LapisAngularis\Senshu\Framework\Nexus\UtilsInterface;

class CoreTemplateUtils implements UtilsInterface
{
    protected $dependencyManager;

    public function __construct(DependencyManagerInterface $dependencyManager)
    {
        $this->dependencyManager = $dependencyManager;
    }

    public function getFrameworkInfo(): string
    {
        return $this->dependencyManager->getContainer('ophagacore.kernel')->getReleaseInfo();
    }

    public function generateUrl(string $action, array $arguments = []): ?string
    {
        return $this->dependencyManager
            ->getContainer('ophagacore.route.router')
            ->generateUrl($action, $arguments)
        ;
    }
}
