<?php

namespace App\DataFixtures;

use Faker\Factory as Faker;
use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create('fr_FR');

        $categories = $this->createCategories($manager);

        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product->setLabel($faker->firstNameMale)
                ->setPrice($faker->randomFloat(2, 500, 100000))
                ->setDescription($faker->text)
                ->setCategory($faker->randomElements($categories)[0])
                ->setItemNumber($faker->randomNumber())
                ->setImages([
                    'http://placehold.it/200x100',
                    'http://placehold.it/200x100',
                    'http://placehold.it/200x100',
                    'http://placehold.it/200x100',
                ]);

            $manager->persist($product);
        }

        $manager->flush();
    }

    private function createCategories(ObjectManager $manager)
    {
        $categories = [];

        $category = new Category();
        $category->setLabel('Petits');
        $categories['petit'] = $category;
        $manager->persist($category);

        $category = new Category();
        $category->setLabel('Moyens');
        $categories['moyen'] = $category;
        $manager->persist($category);

        $category = new Category();
        $category->setLabel('Grands');
        $categories['grand'] = $category;
        $manager->persist($category);

        $category = new Category();
        $category->setLabel('Maquettes');
        $categories['maquette'] = $category;
        $manager->persist($category);

        return$categories;
    }
}
