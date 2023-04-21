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
        return($this->logoRepository->fetchLogo($id));
    }

    public function findUser($id) {
        return $this->userRepository->findUser($id);
    }
    public function saveUser() {

    }
}