<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 21; $i++) {
            $product = new Products();
            $product->setTitle('product #'.$i);
            $product->setPrice(mt_rand(10, 999999));
            $product->setQuantity(mt_rand(0, 100));
            $product->setBuys(mt_rand(0, 100));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
