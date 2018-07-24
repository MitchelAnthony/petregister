<?php

namespace App\Controller\Pet;

use App\Controller\AbstractController;
use App\Entity\Pet\Pet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class FoundPetController extends AbstractController
{
    /**
     * @Route("/pet/found/{id}", name="petregister_pet_found")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet")
     */
    public function __invoke(Request $request, Pet $pet): Response
    {
        dump($pet);

        return new Response('<body></body>', [
            'pet' => $pet,
        ]);
    }
}
