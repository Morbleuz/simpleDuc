<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Developpeur;
use App\Entity\ResponsableRH;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Employe;
use App\Entity\Equipe;
use App\Entity\Projet;
use App\DataFixtures\EmployeFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $projet = new Projet();
        $projet->setNomProjet('Projet Sigma');
        $projet->setEquipe($this->getReference('equipe1'));
        $projet->setCoutTotalEstime('10200');
        $projet->setCoutReel('0');
        $manager->persist($projet);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EquipeFixtures::class,
        ];
    }
}
