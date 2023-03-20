<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Contact;


class ContactFixtures extends Fixture
{
    private $faker;
    

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
    }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<10;$i++){
            $contact = new Contact();
            $contact->setEmail($this->faker->email());
            $contact->setSujet($this->faker->sentence(3));
            $contact->setCommentaire($this->faker->paragraph());
            
            $manager->persist($contact);
        }

        $manager->flush();
    }
}