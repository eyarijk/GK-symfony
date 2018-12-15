<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $categories = $manager->getRepository(Category::class)->findAll();

       for ($i = 0; $i < 20; $i++) {
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
            CategoryFixtures::class
        ];
    }
}
