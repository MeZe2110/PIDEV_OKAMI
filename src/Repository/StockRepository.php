<?php

namespace App\Repository;

use App\Entity\Stock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stock>
 *
 * @method Stock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stock[]    findAll()
 * @method Stock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stock::class);
    }

    public function save(Stock $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Stock $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App:stock p
                WHERE p.nomst LIKE :str'
                
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

    public function findExpired(): array
    {
        foreach ($result as $stock) {
            // Check if the stock is expired
            if ($stock->dateexpirationst <= new \DateTime()) {
                // Display an alert for the expired stock
                $alert = 'Attention! Le stock pour '.$stock->nomst.' est expiré.';
                echo '<script>alert("'.$alert.'")</script>';
            }
        }
    
        return $result;
    }


    public function findstocktByid($id)
    {
        try {
            return $this->getEntityManager()
                ->createQuery(
                    "SELECT p
                FROM App\Entity\Stock
                p WHERE p.id = :id"
                )
                ->setParameter('id', $id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

   
    
    


    
    
     

   
 


    

    



//    /**
//     * @return Stock[] Returns an array of Stock objects
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

//    public function findOneBySomeField($value): ?Stock
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
