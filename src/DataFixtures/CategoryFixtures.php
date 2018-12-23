<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES_FOR_ARTICLES = 'categories-for-articles';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
//         $categories = [];

         $faker = Factory::create();

         $parentCategory = new Category();
         $parentCategory->setName($faker->name);
         $parentCategory->setSlug($faker->slug);
         $parentCategory->setIsEnabled($faker->boolean);

         $manager->persist($parentCategory);
         $manager->flush();

//         $categories[] = $parentCategory;

         for ($i = 0; $i < 30; $i++) {
             $category = new Category();
             $category->setName($faker->name);
             $category->setSlug($faker->slug);
             $category->setIsEnabled($faker->boolean);
             $category->setParent($parentCategory);
             $manager->persist($category);
//             $categories[] = $category;
         }

         $manager->flush();

//        $this->addReference(self::CATEGORIES_FOR_ARTICLES,$categories);
    }
}
