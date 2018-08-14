<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Templating\EngineInterface;

abstract class AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var EngineInterface
     */
    protected $twig;

    /**
     * @var TokenInterface
     */
    protected $token;

    /**
     * @var RouterInterface
     */
    protected $router;

    public function __construct(
        EntityManagerInterface $entityManager,
        EngineInterface $twig,
        TokenStorageInterface $token,
        RouterInterface $router
    ) {
        $this->entityManager = $entityManager;
        $this->twig = $twig;
        $this->token = $token->getToken();
        $this->router = $router;
    }
}