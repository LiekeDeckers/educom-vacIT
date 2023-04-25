<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Sollicitatie;
use App\Entity\Vacature;
use App\Entity\User;

class SollicitatieService {

    private $sollicitatieRepository;
    private $vacatureRepository;
    private $userRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->sollicitatieRepository = $em->getRepository(Sollicitatie::class);
        $this->vacatureRepository = $em->getRepository(Vacature::class);
        $this->userRepository = $em->getRepository(User::class);
    }

    private function fetchUser($id) {
        return($this->userRepository->getUser($id));
    }

    private function fetchVacature($id) {
        return($this->vacatureRepository->getVacature($id));
    }

    public function getSollicitatie($user_id, $vacature_id) {
        return $this->sollicitatieRepository->getSollicitatie($user_id, $vacature_id);
    }

    public function getSollicitaties($vacature_id) {
        return $this->sollicitatieRepository->getSollicitaties($vacature_id);
    }

    public function mijnSollicitaties($user_id) {
        return $this->sollicitatieRepository->mijnSollicitaties($user_id);
    }

    public function saveSollicitatie($params) {
        $data = [
            "id" => (isset($params["id"]) && $params["id"] != "") ? $params["id"] : null,
            "vacature" => $this->fetchVacature($params["vacature"]),
            "user" => $this->fetchUser($params["user"]),
            "uitgenodigd" => $params["uitgenodigd"],              
        ];
  
          $result = $this->sollicitatieRepository->saveSollicitatie($data);
          return($result);
    }

    public function removeSollicitatie($id) {
        return $this->sollicitatieRepository->removeSollicitatie($id);
    }    
}