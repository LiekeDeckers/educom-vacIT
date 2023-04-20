<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VacatureController extends BaseController
{
    #[Route('/vacature', name: 'vacature')]
    public function index(): Response
    {
        return $this->render('vacature/index.html.twig', [
            'controller_name' => 'VacatureController',
        ]);
    }
}
