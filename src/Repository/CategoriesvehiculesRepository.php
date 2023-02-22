<?php

namespace App\Repository;

use App\Entity\Categoriesvehicules;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categoriesvehicules>
 *
 * @method Categoriesvehicules|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoriesvehicules|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoriesvehicules[]    findAll()
 * @method Categoriesvehicules[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesvehiculesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoriesvehicules::class);
    }

    public function save(Categoriesvehicules $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Categoriesvehicules $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Categoriesvehicules[] Returns an array of Categoriesvehicules objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Categoriesvehicules
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
