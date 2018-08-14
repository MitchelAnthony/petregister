<?php

namespace App\Controller\Pet;

use App\Controller\AbstractController;
use App\Entity\Pet\Pet;
use App\Form\PetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class NewPetController extends AbstractController
{
    /**
     * @Route("pet/new", name="petregister_pet_new")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function __invoke(Request $request, FormFactoryInterface $formFactory): Response
    {
        $pet = (new Pet())->setUser($this->token->getUser());
        $form = $formFactory->create(PetType::class, $pet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($pet);
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('petregister_pet_list'));
        }

        return new Response($this->twig->render('Pet/form.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
