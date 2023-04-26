<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\HttpFoundation\Request;

use App\Entity\Vacature;
use App\Service\VacatureService;

#[Route('/')]
class HomepageController extends BaseController
{   
    private $vs; 

    public function __construct(VacatureService $vs) {
        $this->vs = $vs;      
    } 
    
    // overzicht vacatures
    #[Route('/', name: 'homepage')]
    #[Template()]
    public function showVacatures () {
        $vacatures = $this->vs->getAllVacatures();
        return($vacatures);
    }

}