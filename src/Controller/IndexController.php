<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Routing\Annotation\Route;

final class IndexController
{
    private $twig;

    public function __construct(EngineInterface $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="petregister_index")
     */
    public function __invoke()
    {
        return new Response($this->twig->render('index.html.twig'));
    }
}
