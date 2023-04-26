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
    #[Route('/{user_id}/add/{vacature_id}', name: 'candidate_add_solicitatie')]
    #[Template()]
    public function addSollicitatie() {
        $sollicitatie = [
            "id" => 3,
            "vacature" => 2,
            "user" => 1,
            "uitgenodigd" => 0,              
        ];
  
        $result = $this->ss->saveSollicitatie($sollicitatie);
        return($result);
    }

    //verwijder sollicitatie

}
