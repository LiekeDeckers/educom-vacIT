<?php

namespace App\Repository;

use App\Entity\Vacature;
use App\Entity\User; 
use App\Entity\Logo;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vacature>
 *
 * @method Vacature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacature[]    findAll()
 * @method Vacature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacature::class);
    }

    public function getAllVacatures() {
        $vacatures = $this->findAll();
        return($vacatures);
    }

    public function getVacature($vacature_id) {
        $vacature = $this->find($vacature_id);
        return($vacature);
    }

    public function mijnVacatures($user_id) {
        $mijnvacatures = $this->findBy(['user' => $user_id]);
        return($mijnvacatures);
    }

    public function saveVacature($params) {

        if(isset($params["id"]) && $params["id"] != "") {
            $vacature = $this->find($params["id"]);
        } else {
            $vacature = new Vacature();
        }
        
        $vacature->setLogo($params["logo"]);
        $vacature->setUser($params["user"]);
        $vacature->setTitel($params["titel"]);
        $vacature->setDatum($params["datum"]);
        $vacature->setNiveau($params["niveau"]);
        $vacature->setPlaats($params["plaats"]);
        $vacature->setOmschrijving($params["omschrijving"]);

        $this->_em->persist($vacature);
        $this->_em->flush();

        return($vacature);
        
    }

    public function removeVacature($vacature_id) {
        $vacature = $this->find($vacature_id);
        if($vacature) {
            $this->_em->remove($vacature);
            $this->_em->flush();
            return(true);
        }
    
        return(false);
    }

}
