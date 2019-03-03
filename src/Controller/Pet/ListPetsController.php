<?php

declare(strict_types=1);

namespace App\Controller\Pet;

use App\Entity\Pet\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Templating\EngineInterface;

final class ListPetsController
{
    private $tokenStorage;
    private $entityManager;
    private $twig;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager, EngineInterface $twig)
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
        $this->twig = $twig;
    }

    /**
     * @Route("pet/list", name="petregister_pet_list")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function __invoke(Request $request): Response
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $pets = $this->entityManager->getRepository(Pet::class)->findBy(['user' => $user]);

        return new Response($this->twig->render('Pet/list.html.twig', [
            'pets' => $pets,
        ]));
    }
}
