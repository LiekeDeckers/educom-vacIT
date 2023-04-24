<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use App\Entity\User;
use App\Service\UserService;

#[Route('/candidate')]
class CandidateController extends BaseController
{/*
    private $us; 

    public function __construct(UserService $us) {
        $this->us = $us;      
    } 
*/
    #[Route('/', name: 'candidate')]
    #[Template()]
    public function index(): Response
    {
        return $this->render('candidate/index.html.twig', [
            'controller_name' => 'CandidateController',
        ]);
    }
}
