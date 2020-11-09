<?php

namespace App\Repository;

use App\Entity\ModelSpecification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Artprima\QueryFilterBundle\Query\ConditionManager;
use Artprima\QueryFilterBundle\Query\ProxyQueryBuilder;
use Artprima\QueryFilterBundle\QueryFilter\QueryFilterArgs;
use Artprima\QueryFilterBundle\QueryFilter\QueryResult;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method ModelSpecification|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelSpecification|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelSpecification[]    findAll()
 * @method ModelSpecification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelSpecificationRepository extends ServiceEntityRepository
{
    /**
     * @var ConditionManager
     */
    private $conditionManager;

    public function __construct(ManagerRegistry $registry, ConditionManager $manager)
    {
        parent::__construct($registry, ModelSpecification::class);
        $this->conditionManager = $manager;
    }

    public function findByOrderBy(QueryFilterArgs $args): QueryResult
    {
        // Build our request
        $qb = $this->createQueryBuilder('d')
            ->setFirstResult($args->getOffset())
            ->setMaxResults($args->getLimit());

        $proxyQb = new ProxyQueryBuilder($qb, $this->conditionManager);
        $qb = $proxyQb->getSortedAndFilteredQueryBuilder($args->getSearchBy(), $args->getSortBy());
        $query = $qb->getQuery();
        $paginator = new Paginator($query);

        // return the wrapped result
        return new QueryResult($paginator->getIterator()->getArrayCopy(), count($paginator));
    }

    // /**
    //  * @return ModelSpecification[] Returns an array of ModelSpecification objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModelSpecification
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
