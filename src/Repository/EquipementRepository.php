<?php

namespace App\Repository;

use App\Entity\Equipement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Equipement>
 *
 * @method Equipement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipement[]    findAll()
 * @method Equipement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipement::class);
    }

    public function save(Equipement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Equipement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function countBy(): array
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e.id) as count, e.etateq')
            ->groupBy('e.etateq')
            ->getQuery()
            ->getResult();
    }

    public function countByDispo(): array
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e.id) as count, e.dispoeq')
            ->groupBy('e.dispoeq')
            ->getQuery()
            ->getResult();
    }

    public function searchBynom($value)
    {
        return $this->createQueryBuilder('e')
            ->where('e.nomeq LIKE :value OR e.etateq LIKE :value OR e.dispoeq LIKE :value  ')
            ->setParameter('value', '%'.$value.'%')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findAllOrderedByNomeq($order)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e
            FROM App\Entity\Equipement e
            ORDER BY e.nomeq '.$order
        );


        return $query->getResult();
    }
    public function findAllOrderedByEtateq($order)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e
            FROM App\Entity\Equipement e
            ORDER BY e.etateq '.$order
        );


        return $query->getResult();
    }



//    /**
//     * @return Equipement[] Returns an array of Equipement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Equipement
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
