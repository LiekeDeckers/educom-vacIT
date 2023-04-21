<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use App\Service\VacatureService;

//#[Route('/vacature')]
class VacatureController extends AbstractController
{
    private $vs; 

    public function __construct(VacatureService $vs) {
        $this->vs = $vs;      
    }
    
    //#[Route('/vacature', name: 'vacature')]
    //#[Template()]
    /*
    public function index(): Response
    {
        return $this->render('vacature/index.html.twig', [
            'controller_name' => 'VacatureController',
        ]);
    } */

    public function showVacatures() {
        $vacatures = $this->vs->getAllVacatures();
        return($vacatures);
    }

    public function showVacature() {
        $vacature = $this->vs->findVacature($vacature_id);
        return($vacatures);
    }

    
}
