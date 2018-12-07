<?php

namespace App\Repository;

use App\Entity\Platba;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Platba|null find($id, $lockMode = null, $lockVersion = null)
 * @method Platba|null findOneBy(array $criteria, array $orderBy = null)
 * @method Platba[]    findAll()
 * @method Platba[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatbaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Platba::class);
    }

    // /**
    //  * @return Platba[] Returns an array of Platba objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Platba
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
