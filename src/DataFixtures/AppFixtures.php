<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $article = new Articles();
        $manager->persist($article);

        $manager->flush();
    }
}
