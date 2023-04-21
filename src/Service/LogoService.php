<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Logo;

class LogoService {

    private $logoRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->logoRepository = $em->getRepository(Logo::class);
    }

}