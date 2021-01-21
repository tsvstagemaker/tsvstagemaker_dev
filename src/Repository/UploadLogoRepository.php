<?php

namespace App\Repository;

use App\Entity\UploadLogo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UploadLogo|null find($id, $lockMode = null, $lockVersion = null)
 * @method UploadLogo|null findOneBy(array $criteria, array $orderBy = null)
 * @method UploadLogo[]    findAll()
 * @method UploadLogo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UploadLogoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UploadLogo::class);
    }

    // /**
    //  * @return UploadLogo[] Returns an array of UploadLogo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UploadLogo
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
