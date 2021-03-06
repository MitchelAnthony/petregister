<?php

declare(strict_types=1);

namespace App\Controller\Pet;

use App\Entity\Pet\Pet;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Templating\EngineInterface;

final class DeletePetController
{
    private $tokenStorage;
    private $entityManager;
    private $router;
    private $twig;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        EngineInterface $twig
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @Route("pet/{id}/delete", name="petregister_pet_delete")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED') and is_granted('delete', pet)")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet")
     */
    public function __invoke(Request $request, Pet $pet): Response
    {
        if ($request->isMethod('POST') && $request->request->has('confirm')) {
            $this->entityManager->remove($pet);
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('petregister_pet_list'));
        }

        return new Response($this->twig->render('Pet/delete.html.twig', [
            'pet' => $pet,
        ]));
    }
}
