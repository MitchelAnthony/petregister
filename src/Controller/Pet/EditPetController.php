<?php

namespace App\Controller\Pet;

use App\Controller\AbstractCRUDController;
use App\Entity\Pet\Pet;
use App\Form\PetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

final class EditPetController extends AbstractCRUDController
{
    /**
     * @Route("pet/{id}/edit", name="petregister_pet_edit")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet")
     */
    public function __invoke(Request $request, Pet $pet, FormFactoryInterface $formFactory, RouterInterface $router): Response
    {
        if ($pet->getUser() !== $this->token->getUser()) {
            throw new AccessDeniedException();
        }

        $form = $formFactory->create(PetType::class, $pet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pet = $form->getData();

            $this->entityManager->flush();

            return new RedirectResponse($router->generate('petregister_pet_list'));
        }

        return new Response($this->twig->render('Pet/form.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
