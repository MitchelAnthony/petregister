<?php

namespace App\Controller\Pet;

use App\Controller\AbstractCRUDController;
use App\Entity\Pet\Pet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class EditPetController extends AbstractCRUDController
{
    /**
     * @Route("pet/{id}/edit", name="petregister_pet_edit")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     *
     * @ParamConverter("pet", class="App\Entity\Pet\Pet")
     */
    public function __invoke(Request $request, Pet $pet): Response
    {
        return new Response('<body>'. $pet->getName() . '</body>');
    }
}
