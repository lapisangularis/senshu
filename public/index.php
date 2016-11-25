<?php
declare(strict_types = 1);

use LapisAngularis\Senshu\Framework\Core\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'dev';
$senshuApp = new Kernel($environment);

$senshuApp->initialize();