<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\Request;

use App\Entity\Optreden;

#[Route('/')]
class HomepageController extends AbstractController
{
    
    #[Route('/', name: 'homepage')]
    #[Template()]
    public function index() {
        return ['controller_name' => 'HomepageController'];
    }

    #[Route('/backhome', name: 'backhome')]
    public function backhome() {
        return $this->redirectToRoute('homepage');
    }
}