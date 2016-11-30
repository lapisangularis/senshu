<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Controller;

use LapisAngularis\Senshu\Framework\Http\HttpResponse;

interface ControllerInterface
{
    public function standardResponse(array $data): HttpResponse;
    public function redirectResponse(array $data): HttpResponse;
}
