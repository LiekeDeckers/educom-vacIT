<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Logo;

class UserService {

    private $userRepository;
    private $logoRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->userRepository = $em->getRepository(User::class);
        $this->logoRepository = $em->getRepository(Logo::class);
    }

    private function fetchLogo($id) {
        return($this->logoRepository->getLogo($id));
    }

    public function getUser($id) {
        return $this->userRepository->getUser($id);
    }

    public function saveUser($params) {
        $data = [
            "id" => (isset($params["id"]) && $params["id"] != "") ? $params["id"] : null,
            "username" => $params["username"],
            //"roles" => $params["roles"],
            "password" => $params["password"],
            //"logo" => $this->fetchLogo($params["logo_id"]),
            "voornaam" => $params["voornaam"],
            "achternaam" => $params["achternaam"],
            "geboortedatum" => new \DateTime($params["geboortedatum"]),
            "telefoonnummer" => $params["telefoonnummer"],
            "adress" => $params["adress"],
            "postcode" => $params["postcode"],  
            "woonplaats" => $params["woonplaats"], 
            "motivatie" => $params["motivatie"],              
            "cv" => $params["cv"],              
            "profielfoto" => $params["profielfoto"],              
            //"bedrijf" => $params["bedrijf"],                          
        ];
  
          $result = $this->userRepository->saveUser($data);
          return($result);
    }

    public function removeUser($id) {
        return $this->userRepository->removeUser($id);
    }
}