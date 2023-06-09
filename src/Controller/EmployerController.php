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
    public function updateVacature(Request $request, $vacature_id) {
        $user = $this->getUser();
        $vacature = $this->vs->getVacature($vacature_id);
        
        return $this->render('employer/add_vacature.html.twig', (["data" => $vacature]));
    }

    // verwijderen vacature
    #[Route('/verwijder/{vacature_id}', name: 'verwijder_vacature')]
    public function removeVacature(Request $request, $vacature_id) {
        $user = $this->getUser();
        $vacature = $this->vs->getVacature($vacature_id);

        return $this->vs->removeVacature($vacature);
    }

    // bekijk sollicitaties
    #[Route('/sollicitaties/{vacature_id}', name: 'vacature_sollicitaties')]
    #[Template()]
    public function showSollicitaties($vacature_id) {
        $user = $this->getUser();
        $vacature = $this->vs->getVacature($vacature_id);

        $sollicitaties = $this->ss->getSollicitaties($vacature);
        return(['sollicitaties' => $sollicitaties]);
    }

    // save sollicitatie
    #[Route('/savesollicitatie', name: 'save_sollicitatie')]
    public function saveSollicitatie(Request $request) {
        $user = $this->getUser();

        $params['id'] = $request->get('id');
        $params['vacature_id'] = $request->get('vacature_id');
        $params['user_id'] = $request->get('user_id');
        $params['uitgenodigd'] = $request->get('uitgenodigd');

        $result = $this->ss->saveSollicitatie($params);
       
        return $this->redirectToRoute('list_vacatures');
        //return $this->redirectToRoute('vacature_sollicitaties', ['id' => $vacature]);
    }

    // uitnodigen (update sollicitatie)
    #[Route('/uitnodigen/{sollicitatie_id}', name: 'uitnodigen')]
    #[Template()]
    public function uitnodigen(Request $request, $sollicitatie_id) {
        $user = $this->getUser();
        $sollicitatie = $this->ss->getSollicitatie($sollicitatie_id);

        return $this->render('employer/uitnodigen.html.twig', (["data" => $sollicitatie]));
    }
}
