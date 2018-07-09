<?php

namespace App\Repository;

use App\Entity\Term;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Term|null find($id, $lockMode = null, $lockVersion = null)
 * @method Term|null findOneBy(array $criteria, array $orderBy = null)
 * @method Term[]    findAll()
 * @method Term[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TermRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Term::class);
    }

    public function findSearchTerms ($keyword = null) {

        /*
        $dql = "SELECT a FROM App\Entity\Ad a
        WHERE a.category = :cat
        ORDER BY a.dateCreated DESC";
        $query = $this->getEntityManager()->createQuery($dql);
       */

        $qb = $this->createQueryBuilder("a");

        if($keyword) {
            $qb->andWhere("(a.term LIKE :kw)");
            $qb->setParameter("kw", "%$keyword%");
        }

        $query = $qb->getQuery();

        $query->setMaxResults(50);
        $ads = $query->getResult();

        return $ads;
    }

//    /**
//     * @return Term[] Returns an array of Term objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Term
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
