<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\DependencyInjection;

interface DependencyManagerInterface
{
    public function getContainer(string $name);
    public function setContainer(string $name, $service): void;
    public function bootMainConfig(): void;
    public function bootServices(): void;
    public function bootDevServices(): void;
}
