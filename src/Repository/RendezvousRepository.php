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
            ->execute()
        ;
   }

   public function getRendezvousByUser($date, $userId) : array
   {
        return $this->createQueryBuilder('r')
            ->where('r.daterv > :date')
            ->andWhere('User.id = :userId')
            ->setParameters(['date' => $date, 'userId' => $userId])
            ->leftJoin('r.User', 'User')
            ->getQuery()
            ->getResult()
        ;
   }

   public function searchRendezvousByUser($value) : array
   {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.User', 'u')
            ->leftJoin('r.Type', 't')
            ->leftJoin('r.Salle', 's')
            ->where('CONCAT(u.nom, \' \', u.prenom) LIKE :value')
            ->orWhere('CONCAT(\'Salle \', s.etagesa, \'0\', s.numsa) LIKE :value')
            ->orWhere('CONCAT(\'Salle \', s.etagesa, s.numsa) LIKE :value')
            ->orWhere('t.type LIKE :value')
            ->setParameter('value', '%'.$value.'%')
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
   }

   public function statsRendezvous($start, $end) : array
   {
        return $this->createQueryBuilder('r')
            ->select('MONTH(r.daterv) as month, COUNT(r.id) AS rdv')
            ->where('r.daterv BETWEEN :start AND :end')
            ->setParameters(['start'=> $start, 'end'=> $end])
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->getQuery()
            ->getResult()
        ;
   }

   public function statsRendezvousUser() : array
   {
        return $this->createQueryBuilder('r')
            ->select('CONCAT(u.nom, \' \', u.prenom), COUNT(r) AS rdv')
            ->leftJoin('r.User', 'u')
            ->groupBy('u.id')
            ->orderBy('rdv', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
   }

}
