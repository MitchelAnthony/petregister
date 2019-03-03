<?php

declare(strict_types=1);

namespace App\Controller\Pet;

use App\Entity\Pet\Pet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Templating\EngineInterface;

final class SearchPetController
{
    private $twig;

    public function __construct(EngineInterface $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/pet/search/{id}", name="petregister_pet_search")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet", options={"mapping": {"id": "microchipId"}})
     */
    public function __invoke(Request $request, Pet $pet = null): Response
    {
        return new Response($this->twig->render('Pet/search.html.twig', [
            'pet' => $pet,
        ]));
    }
}
