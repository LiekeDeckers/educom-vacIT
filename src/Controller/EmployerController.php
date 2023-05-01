<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use App\Service\UserService;
use App\Service\VacatureService;
use App\Service\SollicitatieService;

use App\Entity\Vacature;

#[Route('/employer')]
class EmployerController extends BaseController
{
    private $us; 
    private $vs;
    private $ss;

    public function __construct(UserService $us, VacatureService $vs, SollicitatieService $ss) {
        $this->us = $us;
        $this->vs = $vs;      
        $this->ss = $ss;            
    }

    // mijn vacatures
    #[Route('/list', name: 'list_vacatures')]
    #[Template()]
    public function showVacatures() {
        $user = $this->getUser();
        $vacatures = $this->vs->mijnVacatures($user);
        return(['vacatures' => $vacatures]);
    }

    // toevoegen vacature 
    #[Route('/add', name: 'add_vacature')]
    #[Template()]
    public function addVacature(Request $request) {
        $user = $this->getUser();
        
        return([]);
    }

    // save vacature 
    #[Route('/save', name: 'save_vacature')]
    public function saveVacature(Request $request) {
        $user = $this->getUser();

        $params['titel'] = $request->get('titel');
        $params['datum'] = $request->get('datum');
        $params['niveau'] = $request->get('niveau');
        $params['plaats'] = $request->get('plaats');
        $params['omschrijving'] = $request->get('omschrijving');
        $params['logo_id'] = $request->get('logo_id');
        $params['user_id'] = $user;

        $result = $this->vs->saveVacature($params);
       
        return $this->redirectToRoute('list_vacatures');
    }

    //update vacature
    #[Route('/update/{vacature_id}', name: 'update_vacature')]
    //#[Template()]
    public function updateVacature(Request $request, $vacature_id) {
        $user = $this->getUser();
        $vacature = $this->vs->getVacature($vacature_id);
        
        return $this->render('employer/add_vacature.html.twig', (["data" => $vacature]));
    }

    // verwijderen vacature
    #[Route('/verwijder/{vacature_id}', name: 'verwijder_vacature')]
    //#[Template()]
    public function removeVacature(Request $request, $vacature_id) {
        $user = $this->getUser();
        $vacature_id = $this->getVacature();

        return $this->vs->removeVacature($vacature_id);
    }

    // bekijk sollicitaties
    #[Route('/sollicitaties/{vacature_id}', name: 'vacature_sollicitaties')]
    #[Template()]
    public function showSollicitaties($vacature_id) {
        $sollicitaties = $this->ss->getSollicitaties($vacature_id);
        return(['sollicitaties' => $sollicitaties]);
    }

    // // uitnodigen
    // #[Route('/{user_id}/{vacature_id}/uitnodigen', name: 'uitnodigen', methods: 'POST')]
    // #[Template()] 
    // public function uitnodigen(Request $request, $user_id, $vacature_id) {
    //     $params = $request->request->all();
    //     $params['user_id'] = $user_id;
    //     $params['vacature_id'] = $vacature_id;

    //     $result = $this->ss->saveSollicitatie($params);
    //     return($result);
    // }
}
