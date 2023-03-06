<?php

namespace App\Repository;

use App\Entity\Vehicules;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Vehicules>
 *
 * @method Vehicules|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicules|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicules[]    findAll()
 * @method Vehicules[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicules::class);
    }

    public function save(Vehicules $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vehicules $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    

//    /**
//     * @return Vehicules[] Returns an array of Vehicules objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vehicules
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function SortBynomvh(){
    return $this->createQueryBuilder('e')
        ->orderBy('e.nomvh','ASC')
        ->getQuery()
        ->getResult()
        ;
}
     public function SortBydispovh() {
        return $this->createQueryBuilder('d')
            ->where('d.dispovh = :dispovh')
            ->setParameter('dispovh', '1')
             ->getQuery()
            ->getResult();
    }
 public function findBynomvh( $nomvh)
{
    return $this-> createQueryBuilder('e')
        ->andWhere('e.nomvh LIKE :nomvh')
        ->setParameter('nomvh','%' .$nomvh. '%')
        ->getQuery()
        ->execute();
}
public function findBydescvh( $descvh)
{
    return $this-> createQueryBuilder('a')
        ->andWhere('a.descvh LIKE :descvh')
        ->setParameter('descvh','%' .$descvh. '%')
        ->getQuery()
        ->execute();
}

public function findEntitiesByString($str){
    return $this->getEntityManager()
        ->createQuery(
            'SELECT p
            FROM App:vehicules p
            WHERE p.nomvh LIKE :str'
            
        )
        ->setParameter('str', '%'.$str.'%')
        ->getResult();
}


}
