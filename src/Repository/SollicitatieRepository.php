<?php

namespace App\Repository;

use App\Entity\Sollicitatie;
use App\Entity\Vacature;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sollicitatie>
 *
 * @method Sollicitatie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sollicitatie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sollicitatie[]    findAll()
 * @method Sollicitatie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SollicitatieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sollicitatie::class);
    }

    public function getSollicitatie($id) {
        $sollicitatie = $this->find($id);
        return($sollicitatie);
    }

    public function getSollicitaties($vacature_id) {
        $sollicitaties = $this->findBy(['vacature' => $vacature_id]);
        return($sollicitaties);
    }

    public function mijnSollicitaties($user_id) {
        $mijnsollicitaties = $this->findBy(['user' => $user_id]);
        return($mijnsollicitaties);
    }

    public function saveSollicitatie($params) {
        if(isset($params["id"]) && $params["id"] != "") {
            $sollicitatie = $this->find($params["id"]);
        } else {
            $sollicitatie = new Sollicitatie();
        }
        
        $sollicitatie->setVacature($params["vacature"]);
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
