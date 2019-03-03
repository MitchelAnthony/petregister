<?php

declare(strict_types=1);

namespace App\Controller\Pet;

use App\Entity\Pet\Pet;
use App\Form\PetType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Templating\EngineInterface;

final class CreatePetController
{
    private $tokenStorage;
    private $formFactory;
    private $entityManager;
    private $router;
    private $twig;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        EngineInterface $twig
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @Route("pet/add", name="petregister_pet_create")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function __invoke(Request $request): Response
    {
        $pet = (new Pet())->setUser($this->tokenStorage->getToken()->getUser());
        $form = $this->formFactory->create(PetType::class, $pet);

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
