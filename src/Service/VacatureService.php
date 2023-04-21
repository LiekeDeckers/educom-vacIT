<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Vacature;
use App\Entity\User;
use App\Entity\Logo;

class VacatureService {

    private $vacatureRepository;
    private $userRepository;
    private $logoRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->vacatureRepository = $em->getRepository(Vacature::class);
        $this->userRepository = $em->getRepository(User::class);
        $this->logoRepository = $em->getRepository(Logo::class);
    }

    private function fetchUser($id = null) {
        if(is_null($id)) return(null);
        return($this->userRepository->fetchUser($id));
    }

    private function fetchLogo($id) {
        return($this->logoRepository->fetchLogo($id));
    }

    public function saveVacature($params) {
        $data = [
            "id" => (isset($params["id"]) && $params["id"] != "") ? $params["id"] : null,
            "titel" => $params["titel"],
            "datum" => new \DateTime($params["datum"]),
            "niveau" => $params["niveau"],
            "plaats" => $params["plaats"],
            "omschrijving" => $params["omschrijving"],              
            "logo" => $this->fetchLogo($params["logo_id"]),
            "user" => $this->fetchUser($params["user_id"]),
        ];
  
          $result = $this->vacatureRepository->saveVacature($data);
          return($result);
    }

    public function findVacature($id)
    {
        return $this->rep->findVacature($id);
    }


    public function getAllVacatures()
    {
        return $this->rep->getAllVacatures();
    }

}
