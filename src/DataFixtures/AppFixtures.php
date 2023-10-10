<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use App\Factory\WishFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        WishFactory::createMany(1);
    }
}
