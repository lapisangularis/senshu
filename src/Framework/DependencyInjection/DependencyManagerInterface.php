<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\DependencyInjection;

interface DependencyManagerInterface
{
    public function getContainer(string $name);
    public function setContainer(string $name, $service);
    public function bootServices();
}
