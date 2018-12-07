<?php

namespace App\Repository;

use App\Entity\Zeme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Zeme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zeme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zeme[]    findAll()
 * @method Zeme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZemeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Zeme::class);
    }

    // /**
    //  * @return Zeme[] Returns an array of Zeme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zeme
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
