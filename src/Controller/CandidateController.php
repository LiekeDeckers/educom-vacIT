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

    // bekijk profiel
    #[Route('/profiel', name: 'candidate_profiel')]
    #[Template()]
    public function showUser() {
        $user = $this->getUser();
        return(['user' => $user]);
    }

    // save user
    #[Route('/save', name: 'save_user')]
    public function saveUser(Request $request) {
        $user = $this->getUser();

        $params['username'] = $request->get('username');
        $params['password'] = $request->get('password');
        $params['voornaam'] = $request->get('voornaam');
        $params['achternaam'] = $request->get('achternaam');
        $params['geboortedatum'] = $request->get('geboortedatum');
        $params['telefoonnummer'] = $request->get('telefoonnummer');
        $params['adress'] = $request->get('adress');
        $params['postcode'] = $request->get('postcode');
        $params['woonplaats'] = $request->get('woonplaats');
        $params['motivatie'] = $request->get('motivatie');
        $params['cv'] = $request->get('cv');
        $params['profielfoto'] = $request->get('profielfoto');
        $params['id'] = $user;

        $result = $this->us->saveUser($params);
       
        return $this->redirectToRoute('candidate_profiel');
    }

    // update user
    #[Route('/update', name: 'update_candidate')]
    public function updateUser(Request $request) {
        $user = $this->getUser(); 
        return $this->render('candidate/show_user.html.twig', ["user" => $user]);
    }

    // mijn sollicitaties
    #[Route('/mijnsollicitaties', name: 'candidate_solicitaties')]
    #[Template()]
    public function showSollicitaties() {
        $user = $this->getUser();
        $sollicitaties = $this->ss->mijnSollicitaties($user);
        return(['sollicitaties' => $sollicitaties]);
    }

    // toevoegen sollicitatie
    #[Route('/add', name: 'add_solicitatie')]
    #[Template()]
    public function addSollicitatie(Request $request) {
        $user = $this->getUser();

        $result = $this->ss->saveSollicitatie($params);
        return($result);
    }

    // save sollicitatie
    #[Route('/savesollicitatie/{vacature_id}', name: 'save_sollicitatie')]
    public function saveSollicitatie(Request $request, $vacature_id) {
        $user = $this->getUser();
        $vacature = $this->vs->getVacature($vacature_id);

        //$params['id'] = $request->get('id');
        $params['vacature_id'] = $vacature;
        $params['user_id'] = $user;
        $params['uitgenodigd'] = 0;

        $result = $this->ss->saveSollicitatie($params);
       
        return $this->redirectToRoute('candidate_solicitaties');
    }

    //verwijder sollicitatie
    #[Route('/verwijder/{sollicitatie_id}', name: 'verwijder_sollicitatie')]
    #[Template()]
    public function removesollicitatie(Request $request, $sollicitatie_id) {
        $result = $this->ss->removeSollicitatie($sollicitatie_id);
        return($result);
    }
}
