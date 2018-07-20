<?php

namespace App\Controller\Pet;

use App\Controller\AbstractController;
use App\Entity\Pet\Pet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SearchPetController extends AbstractController
{
    /**
     * @Route("/pet/search/{id}", name="petregister_pet_search")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet", options={"mapping": {"id": "microchipId"}})
     */
    public function __invoke(Request $request, Pet $pet = null): Response
    {
        dump($pet);

        return new Response('<body></body>');
    }
}
