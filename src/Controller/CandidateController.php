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

    // toevoegen user
    #[Route('/add', name: 'add_candidate', methods: 'POST')]
    #[Template()]
    public function addUser(Request $request) {
        $params = $request->request->all();

        $result = $this->us->saveUser($params);
        return($result);
    }

    // update user
    #[Route('/{user_id}/update', name: 'update_candidate', methods: 'POST')]
    #[Template()]
    public function updateUser(Request $request, $user_id) {
        $params = $request->request->all();
        $params['user_id'] = $user_id;

        $result = $this->us->saveUser($params);
        return($result);
    }

    // mijn sollicitaties
    #[Route('/{user_id}/mijnsollicitaties', name: 'candidate_solicitaties')]
    #[Template()]
    public function showSollicitaties($user_id) {
        $sollicitaties = $this->ss->mijnSollicitaties($user_id);
        return(['sollicitaties' => $sollicitaties]);
    }

    // toevoegen sollicitatie
    #[Route('/{user_id}/{vacature_id}/add', name: 'add_solicitatie', methods: 'POST')]
    #[Template()]
    public function addSollicitatie(Request $request, $user_id, $vacature_id) {
        $params = $request->request->all();
        $params['user_id'] = $user_id;
        $params['vacature_id'] = $vacature_id;

        $result = $this->ss->saveSollicitatie($params);
        return($result);
    }

    //verwijder sollicitatie
    #[Route('/{sollicitatie_id}/verwijder', name: 'verwijder_sollicitatie', methods: 'POST')]
    #[Template()]
    public function removesollicitatie(Request $request, $sollicitatie_id) {
        $result = $this->ss->removeSollicitatie($sollicitatie_id);
        return($result);
    }
}
