<?php

namespace App\Repository;

use App\Entity\Wish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wish>
 *
 * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wish[]    findAll()
 * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wish::class);
    }

    public function findBetweenDateQB($debut, $fin) {
        $qb = $this->createQueryBuilder('w');
        $qb->andWhere('w.dateCreated >= :dateDeDebut');
        $qb->andWhere('w.dateCreated <= :dateDeFin');
        $qb->setParameter('dateDeDebut', $debut);
        $qb->setParameter('dateDeFin', $fin);
        return $qb->getQuery()->getResult();
    }

    public function findBetweenDate($debut, $fin) {
        $em = $this->getEntityManager();
        $dql = "SELECT w FROM App\Entity\Wish w
            WHERE w.dateCreated >= :dateDeDebut
            AND w.dateCreated <= :dateDeFin";
        $requete = $em->createQuery($dql);
        $requete->setParameter('dateDeDebut', $debut);
        $requete->setParameter('dateDeFin', $fin);
        return $requete->getResult();
    }

//    /**
//     * @return Wish[] Returns an array of Wish objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Wish
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
