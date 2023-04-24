<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class BaseController extends AbstractController
{

    

    /*
    public function index(): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        return new Response('Well hi there '.$user->getFirstName());
    }
    */
}
