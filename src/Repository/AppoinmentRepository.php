<?php

namespace App\Repository;

use App\Entity\Appoinment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Appoinment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appoinment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appoinment[]    findAll()
 * @method Appoinment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppoinmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Appoinment::class);
    }

    // /**
    //  * @return Appoinment[] Returns an array of Appoinment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Appoinment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

        public function ValidateQtyPerDay(int $medic_id, $date_start){
        
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = "SELECT COUNT(id)  FROM appoinment 
	                WHERE medic_id = :id AND 
                DATE_FORMAT(start, '%d - %M') = DATE_FORMAT(:date_start, '%d - %M')";
                
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('id', $medic_id);
        $date_start = $date_start->format('Y-m-d');
        $stmt->bindValue('date_start', $date_start);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }


}
