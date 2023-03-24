<?php

namespace App\Repository;

use App\Entity\Developpeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Developpeur>
 *
 * @method Developpeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Developpeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Developpeur[]    findAll()
 * @method Developpeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeveloppeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Developpeur::class);
    }

    public function add(Developpeur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Developpeur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }   

    ///Retourne la liste des projets d'un développeur
    public function getProjet($idDeveloppeur)
    {   

        $q = $this->createQueryBuilder('d');
        $q->leftJoin('d.equipes', 'equipes','WITH')
        ->leftJoin('equipes.projet', 'projet','WITH')     
        ->andWhere('d.id = :id')
        ->setParameter('id', $idDeveloppeur)
        ->groupBy('projet');
        //->orderBy('a.id', 'ASC');
        return $q->getQuery()->getResult();

    }

//    /**
//     * @return Developpeur[] Returns an array of Developpeur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Developpeur
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
