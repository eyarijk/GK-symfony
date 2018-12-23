<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @return Article[]
     */
    public function findArticleByCategoryIds(ArrayCollection $categories): array
    {
        $categoriesIds = $categories->map(function (Category $category) {
            return $category->getId();
        });

        return $this->createQueryBuilder('a')
            ->innerJoin('a.categories', 'c')
            ->where('c.id IN (:categories)')
            ->setParameter(':categories', $categoriesIds)
            ->getQuery()
            ->getResult()
        ;
    }
}
