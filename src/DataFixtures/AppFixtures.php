<?php

namespace App\DataFixtures;

use App\Entity\VinylMix;
use App\Factory\VinylMixFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        VinylMixFactory::createMany(25);
        $manager->flush();
    }
}
