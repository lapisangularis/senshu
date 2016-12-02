<?php
declare(strict_types = 1);

use LapisAngularis\Senshu\Board\App\SenshuKernel;

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'dev';
$senshuApp = new SenshuKernel($environment);

$senshuApp->initialize();
