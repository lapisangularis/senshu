<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Service\Template;

use LapisAngularis\Senshu\Framework\Config\MainConfigInterface;

interface TemplateInterface
{
    public function __construct(MainConfigInterface $config);
    public function loadTemplateEngine(): void;
    public function render(string $template, iterable $variables): string;
}
