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
    #[Route('/profiel/{user_id}', name: 'candidate_profiel')]
    #[Template()]
    public function showUser($user_id) {
        $user = $this->us->getUser($user_id);
        return(['user' => $user]);
    }

    // toevoegen/update user
    #[Route('/save', name: 'candidate_save')]
    #[Template()]
    public function saveUser() {
        $user = [
            "id" => '',
            "username" => '',
            "roles" => [],
            "password" => '',
            "logo" => '',
            "voornaam" => '',
            "achternaam" => '',
            "geboortedatum" => '',
            "telefoonnummer" => '',
            "adress" => '',
            "postcode" => '',
            "woonplaats" => '',
            "motivatie" => '',
            "cv" => '',
            "profielfoto" => '',
        ];
    }

    // mijn sollicitaties
    #[Route('/mijnsollicitaties/{user_id}', name: 'candidate_solicitaties')]
    #[Template()]
    public function showSollicitaties($user_id) {
        $sollicitaties = $this->ss->mijnSollicitaties($user_id);
        return(['sollicitaties' => $sollicitaties]);
    }

    // toevoegen sollicitatie
    #[Route('/{user_id}/add/{vacature_id}', name: 'add_solicitatie', methods: 'POST')]
    #[Template()]
    public function addSollicitatie(Request $request, $user_id, $vacature_id) {
        $params = $request->request->all();
        $params['user_id'] = $user_id;
        $params['vacature_id'] = $vacature_id;

        $result = $this->ss->saveSollicitatie($params);
        return($result);
    }

    //verwijder sollicitatie
    #[Route('/verwijder/{sollicitatie_id}', name: 'verwijder_sollicitatie', methods: 'POST')]
    #[Template()]
    public function removesollicitatie(Request $request, $sollicitatie_id) {
        $result = $this->ss->removeSollicitatie($sollicitatie_id);
        return($result);
    }
}
