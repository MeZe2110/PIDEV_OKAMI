<?php

namespace App\Repository;

use App\Entity\Plannification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Plannification>
 *
 * @method Plannification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plannification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plannification[]    findAll()
 * @method Plannification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlannificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plannification::class);
    }

    public function save(Plannification $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Plannification $entity, bool $flush = false): void
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

        $queryBuilder->select('p')
            ->from(Plannification::class, 'p')
            ->Join('p.salle', 's')
            ->where('s.numsa LIKE :search')
            ->setParameter('search', '%'.$search.'%');

        return $queryBuilder->getQuery()->getResult();
    }



//    /**
//     * @return Plannification[] Returns an array of Plannification objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Plannification
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
