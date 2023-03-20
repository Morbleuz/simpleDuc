<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class AnnonceFixtures extends Fixture implements DependentFixtureInterface
{
    


    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 8; $i++) { 
        $Annonce = new Annonce();
        $Annonce->setNomAnnonce("Nouveau Poste à Synelia");
        $Annonce->setPosteAPromouvoir("Développeur");
        $Annonce->setQualification("C#/JAVA");
        $Annonce->setSalaireDeBase(45000);
        $Annonce->setDescription("Nouvelle description pour le poste de Synelia");
        $Annonce->setResponsableRH($this->getReference("responsable"));

        $manager->persist($Annonce); 
        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            EmployesFixtures::class,
        ];
    }
}