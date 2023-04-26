<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/employer')]
class EmployerController extends BaseController
{
    // find employer (user)
    #[Route('/{user_id}', name: 'employer_profiel')]
    #[Template()]
    public function showUser($user_id) {
        $user = $this->us->getUser($user_id);
        return(['user' => $user]);
    }

    // mijn vacatures
    #[Route('/{user_id}/mijnvacatures', name: 'employer_vacatures')]
    #[Template()]
    public function showVacatures($user_id) {
        $vacature = $this->vs->mijnVacatures($user_id);
        return(['vacatures' => $vacatures]);
    }

    // toevoegen vacature
    #[Route('/{user_id}/add', name: 'add_vacature', methods: 'POST')]
    #[Template()]
    public function addVacature(Request $request, $user_id) {
        $params = $request->request->all();
        $params['user_id'] = $user_id;

        $result = $this->vs->saveVacature($params);
        return($result);
    }

    //update vacature
    #[Route('/{user_id}/update/{vacature_id}', name: 'update_vacature', methods: 'POST')]
    #[Template()]
    public function updateVacature(Request $request, $user_id, $vacature_id) {
        $params = $request->request->all();
        $params['user_id'] = $user_id;
        $params['vacature_id'] = $vacature_id;

        $result = $this->vs->saveVacature($params);
        return($result);
    }

    // verwijderen vacature
    #[Route('/{user_id}/verwijder/{vacature_id}', name: 'verwijder_vacature', methods: 'POST')]
    #[Template()]
    public function removeVacature(Request $request, $vacature_id) {
        $result = $this->vs->removeVacature($vacature_id);
        return($result);
    }

    // bekijk sollicitaties
    #[Route('/{vacature_id}/sollicitaties', name: 'vacature_sollicitaties')]
    #[Template()]
    public function showSollicitanties($vacature_id) {
        $sollicitatie = $this->ss->getSollicitaties($vacature_id);
        return(['sollicitaties' => $sollicitaties]);
    }

    // uitnodigen
    #[Route('/{user_id}/{vacature_id}/uitnodigen', name: 'uitnodigen', methods: 'POST')]
    #[Template()] 
    public function uitnodigen(Request $request, $user_id, $vacature_id) {
        $params = $request->request->all();
        $params['user_id'] = $user_id;
        $params['vacature_id'] = $vacature_id;

        $result = $this->ss->saveSollicitatie($params);
        return($result);
    }
}
