<?php

namespace App\Repository;

use App\Entity\User;
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

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
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

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function SortBynom(){
    return $this->createQueryBuilder('e')
        ->orderBy('e.nom','ASC')
        ->getQuery()
        ->getResult()
        ;
}

public function findBynom( $nom)
{
    return $this-> createQueryBuilder('e')
        ->andWhere('e.nom LIKE :nom')
        ->setParameter('nom','%' .$nom. '%')
        ->getQuery()
        ->execute();
}


public function SortByid(){
    return $this->createQueryBuilder('e')
        ->orderBy('e.id','ASC')
        ->getQuery()
        ->getResult()
        ;
}


public function findEntitiesByString($str){
    return $this->getEntityManager()
        ->createQuery(
            'SELECT p
            FROM App:user p
            WHERE p.nom LIKE :str'
            
        )
        ->setParameter('str', '%'.$str.'%')
        ->getResult();
}
public function findAllOrderedBynom($order)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e
            FROM App\Entity\User e
            ORDER BY e.nom '.$order
        );
    }

    public function order_By_Email()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.email', 'ASC')
            ->getQuery()->getResult();
    }

    public function order_By_Nom()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.nom_ut', 'ASC')
            ->getQuery()->getResult();
    }

  /*  public function search($searchTerm)
    {
        $qb = $this->createQueryBuilder('cd');

        if ($searchTerm) {
            $qb->where('cd.nom_ut LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $searchTerm . '%')
                ->orderBy('cd.nom_ut', 'DESC');
        }

        return $qb->getQuery()->getResult();
    }
*/






//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function Recherche($userM)
    {
          return $this->createQueryBuilder('u')
          ->where('u.userM LIKE :userM')
          ->setParameter('userM',"%". $userM ."%" )
              ->getQuery()->execute();
    }

    public function ListeUparMail()
    {
        return $this->createQueryBuilder('x')
        ->orderBy('x.email' , 'ASC')
        ->getQuery()
        ->getResult();
    }
    public function trie(){
        return $this->createQueryBuilder('u')->orderBy('u.id_ut','ASC')->getQuery()
            ->getResult();
    }
    public function trieN(){
        return $this->createQueryBuilder('u')
        ->orderBy('u.nom_ut','ASC')
        ->getQuery()
        ->getResult();
    }
    public function rechercheC($userName)
    {
        return $this->createQueryBuilder('u')
            ->where('u.id_ut LIKE :cin')
            ->setParameter('id_ut',"%". $userName ."%")
            ->getQuery() ->execute();
    }
    public function rechercheN($nom)
    {
        return $this->createQueryBuilder('u')
            ->where('u.nom_ut LIKE :nom')
            ->setParameter('nom_ut',"%". $nom ."%")
            ->getQuery() ->execute();
    }

}
