<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param array $categoryIds
     * @return Article[]
     */
    public function findArticleByCategoryIds(array $categoryIds): array
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.categories','c')
            ->where('c.id IN (:categories)')
            ->setParameter(':categories',$categoryIds)
            ->getQuery()
            ->getResult()
        ;
    }
}
