<?php

declare(strict_types=1);

namespace App\Controller\Pet;

use App\Entity\Notification;
use App\Entity\Pet\Pet;
use App\Entity\User\Contact;
use App\Enum\Preference;
use App\Form\NotificationType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;

final class FoundPetController
{
    private $formFactory;
    private $entityManager;
    private $router;
    private $twig;

    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        RouterInterface $router,
        EngineInterface $twig
    ) {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->twig = $twig;
    }

    /**
     * @Route("/pet/found/{id}", name="petregister_pet_found")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet")
     */
    public function __invoke(Request $request, Pet $pet): Response
    {
        $contacts = [];
        /** @var Contact $contact */
        foreach ($pet->getUser()->getContacts() as $contact) {
            if ($contact->getPreference()->getValue() >= (new Preference(Preference::ALLOW_VISITORS))->getValue()) {
                $contacts[] = $contact;
            }
        }

        $notification = (new Notification())->setReceiver($pet->getUser());
        $form = $this->formFactory->create(NotificationType::class, $notification, ['add_receiver' => false]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->setDate(new \DateTime());

            $this->entityManager->persist($notification);
            $this->entityManager->flush();

            return new RedirectResponse($this->router->generate('petregister_index'));
        }

        return new Response($this->twig->render('Pet/found.html.twig', [
            'pet' => $pet,
            'form' => $form->createView(),
            'contacts' => $contacts,
        ]));
    }
}
