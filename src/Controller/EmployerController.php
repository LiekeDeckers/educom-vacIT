<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployerController extends BaseController
{
    #[Route('/employer', name: 'employer')]
    public function index(): Response
    {
        return $this->render('employer/index.html.twig', [
            'controller_name' => 'EmployerController',
        ]);
    }
}
