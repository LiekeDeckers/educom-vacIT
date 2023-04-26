<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployerController extends BaseController
{
    // find employer (user)

    // find mijnVacatures

    // toevoegen/update vacature
    #[Route('/add/{id}', name: 'add_vacature')]
    public function addVacature() {
        $vacature = [
            "id" => 3,
            "logo_id" => 2,
            "user_id" => 2,
            "titel" => 'Software Developper',
            "datum" => '2023-04-24',
            "niveau" => 'Medior',
            "plaats" => 'Sittard',
            "omschrijving" => 'blablabla',
        ];
  
        $result = $this->vs->saveVacature($vacature);
        return($result);
    }
    
    // verwijderen vacature

    // bekijk sollicitanten

    // uitnodigen 

    
}
