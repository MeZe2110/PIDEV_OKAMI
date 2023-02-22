<?php

namespace App\Repository;

use App\Entity\Categoriesequipement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categoriesequipement>
 *
 * @method Categoriesequipement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoriesequipement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoriesequipement[]    findAll()
 * @method Categoriesequipement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesequipementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoriesequipement::class);
    }

    public function save(Categoriesequipement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Categoriesequipement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Categoriesequipement[] Returns an array of Categoriesequipement objects
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

//    public function findOneBySomeField($value): ?Categoriesequipement
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
