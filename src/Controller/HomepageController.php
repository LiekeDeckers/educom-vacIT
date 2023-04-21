<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\Request;

use App\Entity\Vacature;


#[Route('/')]
class HomepageController extends AbstractController
{
    private $vs; 

    public function __construct(VacatureService $vs) {
        $this->vs = $vs;      
    } 
    
    #[Route('/', name: 'homepage')]
    #[Template()]
    public function index(): Response
        {
            return $this->render('homepage/index.html.twig', [
                'controller_name' => 'HomepageController',
            ]);
        }
        /* 
        {
        $rep = $this->getDoctrine()->getRepository(Vacature::class);
        $data = $rep->getAllVacatures();

        dd($data);
    } */

    #[Route('/backhome', name: 'backhome')]
    public function backhome() {
        return $this->redirectToRoute('homepage');
    }
}