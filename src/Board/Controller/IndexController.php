<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Controller;

use LapisAngularis\Senshu\Framework\Http\HttpResponse;
use LapisAngularis\Senshu\Framework\Controller\BaseController;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $content = $this->renderTemplate('index.html.twig', [
            'mainContent' => 'PHP7 based Imageboard'
        ]);

        return $this->standardResponse([
            'content' => $content,
            'statusCode' => 200
        ]);
//        return $this->redirectResponse([
//            'url' => '/version'
//        ]);
    }

    public function testAction(string $text)
    {
        $content = "Some text: " . $text;

        return $this->standardResponse([
            'content' => $content,
            'statusCode' => 200
        ]);
    }

    public function versionAction()
    {
        $content = $this->dependencyManager->getContainer('ophagacore.kernel')->getReleaseInfo();

        return $this->standardResponse([
            'content' => $content,
            'statusCode' => 200
        ]);
    }
}
