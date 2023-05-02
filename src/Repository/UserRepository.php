<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Logo;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getUser($id) {
        return($this->find($id));
    }

    public function saveUser($params) {
        if(isset($params["id"]) && $params["id"] != "") {
            $user = $this->find($params["id"]);
        } else {
            $user = new User();
        }
        
        $user->setUsername($params["username"]);
        //$user->setRoles($params["roles"]);
        $user->setPassword($params["password"]);
        //$user->setLogo($params["logo"]);
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
        //$user->setBedrijf($params["bedrijf"]);

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


    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }

}
