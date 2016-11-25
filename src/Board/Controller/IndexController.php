<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Controller;

use LapisAngularis\Senshu\Framework\Http\HttpResponse;

class IndexController
{
    public function indexAction()
    {
        $content = 'This is index.';
        $response = new HttpResponse();
        $response->setContent($content);

        foreach ($response->getHeaders() as $header) {
            header($header, false);
        }

        echo $response->getContent();
        return $response;
    }

    public function versionAction()
    {
        $content = 'This is version.';
        $response = new HttpResponse();
        $response->setContent($content);

        foreach ($response->getHeaders() as $header) {
            header($header, false);
        }

        echo $response->getContent();
        return $response;
    }
}