<?php

namespace App\Repository;

use App\Entity\Rendezvous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rendezvous>
 *
 * @method Rendezvous|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rendezvous|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rendezvous[]    findAll()
 * @method Rendezvous[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendezvousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rendezvous::class);
    }

    public function save(Rendezvous $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Rendezvous $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


   public function getRendezvous($date): array
   {
        return $this->createQueryBuilder('r')
            ->where('r.daterv > :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
        ;
   }

   public function getOldRendezvous($date): array
   {
        return $this->createQueryBuilder('r')
            ->where('r.daterv <= :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
        ;
   }

   public function clearOldRendezvous($date) : array
   {
        return $this->createQueryBuilder('r')
                ->delete()
                ->where('r.daterv <= :date')
                ->setParameter('date', $date)
                ->getQuery()
                ->execute();
   }

   public function getRendezvousByUser($date, $userId) : array
   {
    return $this->createQueryBuilder('r')
            ->where('r.daterv > :date')
            ->andWhere('Utilisateur.id = :userId')
            ->setParameters(['date' => $date, 'userId' => $userId])
            ->leftJoin('r.Utilisateur', 'Utilisateur')
            ->getQuery()
            ->getResult();
   }


}
