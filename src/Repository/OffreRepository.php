<?php

namespace App\Repository;

use App\Entity\Offre;
use App\Entity\Recherche;
use App\Entity\RechercheOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    /**
     * @return Query
     */
    public function findByCpOrDomaine($cp, $domaine)
    {
        $query = $this->createQueryBuilder('o')
            ->where('o.code_postal LIKE :codePostal')
            ->andWhere('o.domaine LIKE :domaine')
            ->setParameter('codePostal', '%' . $cp . '%')
            ->setParameter('domaine', '%' . $domaine . '%')
            ->orderBy('o.create_at', 'DESC')
            ->getQuery()
            ->execute();

        return $query;
    }

    // /**
    //  * @return Offre[] Returns an array of Offre objects
    //  */

    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('o')
    //         ->andWhere('o.code_postal = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('o.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }


    /*
    public function findOneBySomeField($value): ?Offre
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
