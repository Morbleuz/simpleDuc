<?php

namespace App\Repository;

use App\Entity\ResponsableRH;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResponsableRH>
 *
 * @method ResponsableRH|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponsableRH|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponsableRH[]    findAll()
 * @method ResponsableRH[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsableRHRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsableRH::class);
    }

    public function add(ResponsableRH $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ResponsableRH $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ResponsableRH[] Returns an array of ResponsableRH objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ResponsableRH
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
