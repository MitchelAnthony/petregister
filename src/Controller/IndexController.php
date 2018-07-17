<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @var EngineInterface
     */
    protected $twig;

    public function __construct(EngineInterface $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="petregister_index")
     */
    public function __invoke()
    {
        return new Response($this->twig->render('base.html.twig'));
    }
}