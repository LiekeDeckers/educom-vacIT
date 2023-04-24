<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use App\Service\UserService;
use App\Service\VacatureService;
use App\Service\SollicitatieService;

#[Route('/candidate')]
class CandidateController extends BaseController
{
    private $us; 
    private $vs;
    private $ss;

    public function __construct(UserService $us, VacatureService $vs, SollicitatieService $ss) {
        $this->us = $us;
        $this->vs = $vs;      
        $this->ss = $ss;            
    } 

    #[Route('/profiel/{id}', name: 'candidate_profiel')]
    #[Template()]
    public function showUser($id) {
        $user = $this->us->getUser($id);
        return($user);
    }

    #[Route('/mijnsollicitaties/{id}', name: 'candidate_solicitaties')]
    public function showSolicitaties($id) {
        $sollicitaties = $this->ss->mijnSollicitaties($id);
        dd($sollicitaties);
    }

    #[Route('/save/{id}', name: 'candidate_save_solicitatie')]
    public function saveSollicitatie() {

    }

}
