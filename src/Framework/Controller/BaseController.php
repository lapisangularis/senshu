<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Controller;

use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;
use LapisAngularis\Senshu\Framework\Http\HttpResponse;

abstract class BaseController
{
    protected $dependencyManager;
    protected $httpRequest;

    public function __construct(DependencyManagerInterface $dependencyManager)
    {
        $this->dependencyManager = $dependencyManager;
        $this->httpRequest = $dependencyManager->getContainer('ophagacore.http.request');
    }

    public function standardResponse(HttpResponse $response, array $data): HttpResponse
    {
        $response->setContent($data['content']);
        $response->setStatusCode($data['statusCode']);

        foreach ($response->getHeaders() as $header) {
            header($header, false);
        }

        echo $response->getContent();
        return $response;
    }
}
