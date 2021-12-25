<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ShoppingList;
use App\Entity\ShoppingListItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ShoppingListFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = $manager->getRepository(Product::class)->findAll();

        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $list = new ShoppingList();
            $list->setName($faker->text(50));
            $list->setCreatedAt($faker->dateTime());
            $manager->persist($list);

            for ($j = 0; $j < random_int(2, 20); $j++) {
                $item = new ShoppingListItem();
                $item->setQuantity(random_int(1,5));
                shuffle($products);
                $item->setProduct($products[0]);
                $item->setList($list);
                $manager->persist($item);
            }
        }
        $manager->flush();
    }
}
