<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use App\Service\VacatureService;

#[Route('/vacature')]
class VacatureController extends BaseController
{
    private $vs; 

    public function __construct(VacatureService $vs) {
        $this->vs = $vs;      
    }

    #[Route('/show/{id}', name: 'show_vacature')]
    #[Template()]
    public function showVacature($id) {
        $vacature = $this->vs->getVacature($id);
        return(['vacature' => $vacature]);
    }

    #[Route('/add/{id}', name: 'add_vacature')]
    #[Template()] 
    public function addVacature() {
        $vacature = [
            "id" => 3,
            "titel" => 'Software Developper',
            "datum" => '2023-04-24',
            "niveau" => 'Medior',
            "plaats" => 'Sittard',
            "omschrijving" => 'blablabla',              
            "logo" => 2,
            "user" => 2,
        ];
  
        $result = $this->vs->saveVacature($vacature);
        return($result);
    }
        
}
