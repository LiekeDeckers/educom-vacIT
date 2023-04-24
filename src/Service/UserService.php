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

    public function fetchUser($id) {
        return $this->userRepository->getUser($id);
    }

    public function saveUser($params) {
        if(isset($params["id"]) && $params["id"] != "") {
            $user = $this->find($params["id"]);
        } else {
            $user = new User();
        }
        
        $user->setUsername($params["username"]);
        $user->setRoles($params["roles"]);
        $user->setPassword($params["password"]);
        $user->setLogo($params["logo"]);
        $user->setVoornaam($params["voornaam"]);
        $user->setAchternaam($params["achternaam"]);
        $user->setGeboortedatum($params["geboortedatum"]);
        $user->setTelefoonnummer($params["telefoonnummer"]);
        $user->setAdress($params["adress"]);
        $user->setPostcode($params["postcode"]);
        $user->setWoonplaats($params["woonplaats"]);
        $user->setMotivatie($params["motivatie"]);
        $user->setCv($params["cv"]);
        $user->setProfielfoto($params["profielfoto"]);
        $user->setLogo($params["bedrijf"]);

        $this->_em->persist($user);
        $this->_em->flush();

        return($user);
    }

    public function removeUser($id) {
        $user = $this->find($id);
        if($user) {
            $this->_em->remove($user);
            $this->_em->flush();
            return(true);
        }
    
        return(false);
    }
}