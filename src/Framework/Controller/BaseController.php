<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Controller;

use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;
use LapisAngularis\Senshu\Framework\Http\HttpResponse;

abstract class BaseController implements ControllerInterface
{
    protected $dependencyManager;
    protected $httpRequest;

    public function __construct(DependencyManagerInterface $dependencyManager)
    {
        $this->dependencyManager = $dependencyManager;
        $this->httpRequest = $dependencyManager->getContainer('ophagacore.http.request');
    }

    public function standardResponse(array $data): HttpResponse
    {
        $response = new HttpResponse();
        $response->setContent($data['content']);
        $response->setStatusCode($data['statusCode']);
        $response->sendAllHttpHeaders();

        echo $response->getContent();
        return $response;
    }

    public function redirectResponse(array $data): HttpResponse
    {
        $response = new HttpResponse();
        $response->redirect($data['url']);
        $response->sendAllHttpHeaders();

        echo $response->getContent();
        return $response;
    }

    public function renderTemplate(string $template, array $variables = []): string
    {
        $arguments = [
            'template' => $template,
            'variables' => $variables
        ];

        return $this->dependencyManager->getContainer('ophagacore.middleware.templates')->render($arguments);
    }
}
