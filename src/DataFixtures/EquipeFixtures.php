<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Developpeur;
use App\Entity\ResponsableRH;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Employe;
use App\Entity\Equipe;
use App\DataFixtures\EmployeFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EquipeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $equipe = new Equipe();
        $equipe->setNomEquipe('Sigma Team');
        $equipe->addDeveloppeur($this->getReference('developpeur1'));
        $equipe->addDeveloppeur($this->getReference('developpeur2'));
        
        $manager->persist($equipe);
        $this->getReference('developpeur1')->addEquipe($equipe);
        $manager->persist($this->getReference('developpeur1'));

        $this->getReference('developpeur2')->addEquipe($equipe);
        $manager->persist($this->getReference('developpeur2'));

        $this->setReference('equipe1', $equipe);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EmployesFixtures::class,
        ];
    }
}
