<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $parentCategory = $this->getReference(CategoryFixtures::PARENT_CATEGORY_FOR_CATEGORIES);

        $categories = $manager->getRepository(Category::class)
            ->findBy([
                'parent' => $parentCategory,
            ]);

        for ($i = 0; $i < 20; ++$i) {
            $article = new Article();
            $article->setIsEnabled($faker->boolean);
            $article->setTitle($faker->title);
            $article->setSlug($faker->slug);
            $article->setCreatedAt($faker->dateTime);
            $article->setUpdatedAt($article->getCreatedAt());

            foreach ($categories as $category) {
                $article->addCategory($category);
            }
            $manager->persist($article);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
