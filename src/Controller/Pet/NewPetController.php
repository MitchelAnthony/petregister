<?php

namespace App\Controller\Pet;

use App\Controller\AbstractCRUDController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class NewPetController extends AbstractCRUDController
{
    /**
     * @Route("pet/new", name="petregister_pet_new")
     *
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function __invoke(Request $request): Response
    {
        return new Response('<body>New Pet! :-)</body>');
    }
}
