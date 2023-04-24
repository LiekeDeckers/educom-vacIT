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

    public function getSollicitatie($id) {
        return $this->sollicitatieRepository->getSollicitatie($id);
    }

    public function getSollicitaties($vacature_id) {
        return $this->sollicitatieRepository->getSollicitaties($vacature_id);
    }

    public function mijnSollicitaties($user_id) {
        return $this->sollicitatieRepository->mijnSollicitaties($user_id);
    }

    public function saveSollicitatie($params) {
        if(isset($params["id"]) && $params["id"] != "") {
            $sollicitatie = $this->find($params["id"]);
        } else {
            $sollicitatie = new Sollicitatie();
        }
        
        $sollicitatie->setVacature($params["logo"]);
        $sollicitatie->setUser($params["user"]);
        $sollicitatie->setUitgenodigd($params["uitgenodigd"]);

        $this->_em->persist($sollicitatie);
        $this->_em->flush();

        return($sollicitatie);
    }

    public function removeSollicitatie($id) {
        $sollicitatie = $this->find($id);
        if($sollicitatie) {
            $this->_em->remove($sollicitatie);
            $this->_em->flush();
            return(true);
        }
    
        return(false);
    }    
}