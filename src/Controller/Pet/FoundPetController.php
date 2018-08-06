<?php

namespace App\Controller\Pet;

use App\Controller\AbstractController;
use App\Entity\Notification;
use App\Entity\Pet\Pet;
use App\Entity\User\Contact;
use App\Enum\Preference;
use App\Form\NotificationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

final class FoundPetController extends AbstractController
{
    /**
     * @Route("/pet/found/{id}", name="petregister_pet_found")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet")
     */
    public function __invoke(Request $request, Pet $pet, FormFactoryInterface $formFactory, RouterInterface $router): Response
    {
        $contacts = [];
        /** @var Contact $contact */
        foreach ($pet->getUser()->getContacts() as $contact) {
            if ($contact->getPreference()->getValue() >= (new Preference(Preference::ALLOW_VISITORS))->getValue()) {
                $contacts[] = $contact;
            }
        }

        $notification = (new Notification())->setReceiver($pet->getUser());
        $form = $formFactory->create(NotificationType::class, $notification, ['add_receiver' => false]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->setDate(new \DateTime());

            $this->entityManager->persist($notification);
            $this->entityManager->flush();

            return new RedirectResponse($router->generate('petregister_index'));
        }

        return new Response($this->twig->render('Pet/found.html.twig', [
            'pet' => $pet,
            'form' => $form->createView(),
            'contacts' => $contacts,
        ]));
    }
}
