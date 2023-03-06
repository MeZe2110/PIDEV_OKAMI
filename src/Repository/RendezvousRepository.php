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

   public function searchRendezvousByUser($value) : array
   {
        return $this->createQueryBuilder('r')
                ->leftJoin('r.Utilisateur', 'u')
                ->leftJoin('r.Type', 't')
                ->leftJoin('r.Salle', 's')
                ->where('CONCAT(u.nomut, \' \', u.prenomut) LIKE :value')
                ->orWhere('CONCAT(\'Salle \', s.etagesa, \'0\', s.numsa) LIKE :value')
                ->orWhere('CONCAT(\'Salle \', s.etagesa, s.numsa) LIKE :value')
                ->orWhere('t.type LIKE :value')
                ->setParameter('value', '%'.$value.'%')
                ->orderBy('u.id', 'ASC')
                ->getQuery()
                ->getResult();
   }

   public function statsRendezvous($start, $end) : array
   {

        return $this->createQueryBuilder('r')
                ->where('r.daterv BETWEEN :start AND :end')
                ->setParameters(['start' => $start, 'end' => $end])
                ->getQuery()
                ->getResult();
   }

   // Function to get the 3 users that went to the most rendez-vous
   // Function that compare the number of rendezvous of all months for a year

   public function statsRendezvousUser() : array
   {
        return $this->createQueryBuilder('r')
                ->leftJoin('r.Utilisateur', 'u')
                
                ->getQuery()
                ->getResult();
   }

   // I have two entities "rendezvous" and "user" with a ManyToMany relationship
   // From the rendezvousRepository, I wish to create a Query that returns the User with the highest number of rendez-vous
   // From the rendezvousRepository, I wish to create a Query that returns the number of rendez-vous per month over a year.
}
