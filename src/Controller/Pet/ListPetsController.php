<?php

namespace App\Controller\Pet;

use App\Controller\AbstractCRUDController;
use App\Entity\Pet\Pet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListPetsController extends AbstractCRUDController
{
    /**
     * @Route("pet/list", name="petregister_pet_list")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function __invoke(Request $request): Response
    {
        $user = $this->token->getToken()->getUser();
        $pets = $this->entityManager->getRepository(Pet::class)->findByUser($user);
        if (null === $pets) {
            $pets = [];
        }

        return new Response($this->twig->render('Pet/list.html.twig', [
            'pets' => $pets,
        ]));
    }
}