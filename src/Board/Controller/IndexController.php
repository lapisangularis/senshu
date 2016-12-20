<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Board\Controller;

use LapisAngularis\Senshu\Framework\Http\HttpResponse;
use LapisAngularis\Senshu\Framework\Controller\BaseController;
use LapisAngularis\Senshu\Framework\DependencyInjection\DependencyManagerInterface;

class IndexController extends BaseController
{
    private $userRepository;

    public function __construct(DependencyManagerInterface $dependencyManager)
    {
        parent::__construct($dependencyManager);

        $this->userRepository = $dependencyManager->getContainer('senshu.user.repository');
    }

    public function indexAction(): HttpResponse
    {
        $content = $this->renderTemplate('exampletemplate/actions/index.html.twig', [
            'mainContent' => 'PHP7 based Imageboard'
        ]);

        return $this->standardResponse([
            'content' => $content,
            'statusCode' => 200
        ]);
    }

    public function testAction(int $id): HttpResponse
    {
        $user = $this->userRepository->findById($id);

        $content = $this->renderTemplate('exampletemplate/actions/test.html.twig', [
            'user' => $user
        ]);

        return $this->standardResponse([
            'content' => $content,
            'statusCode' => 200
        ]);
    }

    public function versionAction(): HttpResponse
    {
        $content = $this->renderTemplate('exampletemplate/actions/version.html.twig');

        return $this->standardResponse([
            'content' => $content,
            'statusCode' => 200
        ]);
    }
}
