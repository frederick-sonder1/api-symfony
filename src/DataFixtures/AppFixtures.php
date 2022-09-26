<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\User;
use App\Entity\Comments;



class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <= 20; $i++) { 
            $article = new Articles();
            $article->setTitre($this->faker->sentence(4))
                ->setArticle($this->faker->paragraph)
                ->setUser($this->faker->int)
                ->setDate($this->faker->dateTimeBetween('-6 months'));
            $manager->persist($article);
        }
        for ($i=1; $i <= 10; $i++) { 
            $user = new User();
            $user->setusername($this->faker->username)
                ->setPassword($this->faker->password)
                ->setRoles(['ROLE_USER']);
            $manager->persist($user);
        }
        for ($i=1; $i <= 20; $i++) { 
            $comment = new Comments();
            $comment->setComment($this->faker->paragraph)
                ->setDate($this->faker->dateTimeBetween('-6 months'));
            $manager->persist($comment);
        }
        
        $manager->flush();
    }
}
