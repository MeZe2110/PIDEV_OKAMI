<?php

namespace App\Repository;

use App\Entity\Stockcategories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stockcategories>
 *
 * @method Stockcategories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stockcategories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stockcategories[]    findAll()
 * @method Stockcategories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockcategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stockcategories::class);
    }

    public function save(Stockcategories $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Stockcategories $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBySearch(string $search): array
 {
    $entityManager = $this->getEntityManager();
    $queryBuilder = $entityManager->createQueryBuilder();

    $queryBuilder->select('s')
        ->from(Stockcategories::class, 's')
        ->where($queryBuilder->expr()->like('s.typecat', $queryBuilder->expr()->literal($search . '%')));

    $query = $queryBuilder->getQuery();
    return $query->getResult();
 }



//    /**
//     * @return Stockcategories[] Returns an array of Stockcategories objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Stockcategories
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
