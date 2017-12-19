<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Config;

use LapisAngularis\Senshu\Framework\Config\CoreMainConfig;

class SenshuMainConfig extends CoreMainConfig
{
    public function createConfig(): void
    {
        require_once __DIR__ . '/../../../config/config.php';

        $this->config = $config;
    }

    public function createDevConfig(): void
    {
        $this->createConfig();
        $config = $this->config;

        require_once __DIR__ . '/../../../config/config_dev.php';

        $this->config = $config;
    }
}
