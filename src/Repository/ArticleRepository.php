<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Category;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
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
     * @param ArrayCollection $categories
     * @return Query
     */
    public function findArticleByCategoriesQuery(ArrayCollection $categories): Query
    {
        $categoriesIds = $categories->map(function (Category $category) {
            return $category->getId();
        });

        return $this->createQueryBuilder('a')
            ->innerJoin('a.categories', 'c')
            ->where('c.id IN (:categories)')
            ->setParameter(':categories', $categoriesIds)
            ->getQuery()
        ;
    }

    /**
     * @param DateTime $start
     * @param DateTime $finish
     * @return Query
     */
    public function findByPeriodQuery(DateTime $start, DateTime $finish): Query
    {
        return $this->createQueryBuilder('a')
            ->where('a.createdAt >= :start')
            ->andWhere('a.createdAt <= :finish')
            ->setParameters([
                ':start' => $start,
                ':finish' => $finish,
            ])
            ->getQuery()
        ;
    }
}
