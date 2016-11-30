<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Service\Template;

use LapisAngularis\Senshu\Framework\Config\MainConfigInterface;

interface TemplateInterface
{
    public function __construct(MainConfigInterface $config);
    public function loadTemplateEngine();
    public function render(string $template, array $variables): string;
}
