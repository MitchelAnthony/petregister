<?php

namespace App\Controller\Pet;

use App\Controller\AbstractCRUDController;
use App\Entity\Pet\Pet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

final class DeletePetController extends AbstractCRUDController
{
    /**
     * @Route("pet/{id}/delete", name="petregister_pet_delete")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet")
     */
    public function __invoke(Request $request, Pet $pet, RouterInterface $router): Response
    {
        if ($pet->getUser() !== $this->token->getUser()) {
            throw new AccessDeniedException();
        }

        if ($request->isMethod('POST') && $request->request->has('confirm')) {
            $this->entityManager->remove($pet);
            $this->entityManager->flush();

            return new RedirectResponse($router->generate('petregister_pet_list'));
        }

        return new Response($this->twig->render('Pet/delete.html.twig', [
            'pet' => $pet,
        ]));
    }
}
