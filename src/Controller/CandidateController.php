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
        $params['user_id'] = $user;

        $result = $this->us->saveUser($params);
       
        return $this->redirectToRoute('candidate_profiel');
    }

    // update user
    #[Route('/update', name: 'update_candidate')]
    public function updateUser(Request $request) {
        $user = $this->getUser(); 

        return $this->render('candidate/show_user.html.twig', (["data" => $user]));
    }

    // mijn sollicitaties
    #[Route('/{user_id}/mijnsollicitaties', name: 'candidate_solicitaties')]
    #[Template()]
    public function showSollicitaties($user_id) {
        $sollicitaties = $this->ss->mijnSollicitaties($user_id);
        return(['sollicitaties' => $sollicitaties]);
    }

    // toevoegen sollicitatie
    #[Route('/{user_id}/{vacature_id}/add', name: 'add_solicitatie')]
    #[Template()]
    public function addSollicitatie(Request $request, $user_id, $vacature_id) {
        $params = $request->request->all();
        $params['user_id'] = $user_id;
        $params['vacature_id'] = $vacature_id;

        $result = $this->ss->saveSollicitatie($params);
        return($result);
    }

    //verwijder sollicitatie
    #[Route('/{sollicitatie_id}/verwijder', name: 'verwijder_sollicitatie')]
    #[Template()]
    public function removesollicitatie(Request $request, $sollicitatie_id) {
        $result = $this->ss->removeSollicitatie($sollicitatie_id);
        return($result);
    }
}
