<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Developpeur;
use App\Entity\ResponsableRH;
use App\Entity\Employe;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EmployesFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher= $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product); 

        ///Ajout de plusieurs développeurs
        $developpeur = new Developpeur();
        $developpeur->setEmail("developpeur@simpleduc.fr");
        $developpeur->setPassword("motdepasse");
        $developpeur->setRoles(array("ROLE_DEV", "ROLE_EMP"));
        $developpeur->setNom("Martin");
        $developpeur->setPrenom("Tom");
        $developpeur->setRIB("FR1O32O2OI32OI");
        $developpeur->setNombreHeures(36);
        $developpeur->setAdresse("4 rue de guymo");
        $developpeur->setSexe("Homme");
        $developpeur->setPassword(
            $this->passwordHasher->hashPassword(
                $developpeur,
                $developpeur->getPassword()
            )
        );
        $manager->persist($developpeur);
        $this->addReference('developpeur1', $developpeur);

        $developpeur = new Developpeur();
        $developpeur->setEmail("developpeur2@simpleduc.fr");
        $developpeur->setPassword("motdepasse");
        $developpeur->setRoles(array("ROLE_DEV", "ROLE_EMP"));
        $developpeur->setNom("Martin");
        $developpeur->setPrenom("Tom");
        $developpeur->setRIB("FR1O32O2OI32OI");
        $developpeur->setNombreHeures(36);
        $developpeur->setAdresse("4 rue de guymo");
        $developpeur->setSexe("Homme");
        $developpeur->setPassword(
            $this->passwordHasher->hashPassword(
                $developpeur,
                $developpeur->getPassword()
            )
        );
        $manager->persist($developpeur);
        $this->addReference('developpeur2', $developpeur);


        $developpeur = new Developpeur();
        $developpeur->setEmail("developpeur3@simpleduc.fr");
        $developpeur->setPassword("motdepasse");
        $developpeur->setRoles(array("ROLE_DEV", "ROLE_EMP"));
        $developpeur->setNom("Martin");
        $developpeur->setPrenom("Tom");
        $developpeur->setRIB("FR1O32O2OI32OI");
        $developpeur->setNombreHeures(36);
        $developpeur->setAdresse("4 rue de guymo");
        $developpeur->setSexe("Homme");
        $developpeur->setPassword(
            $this->passwordHasher->hashPassword(
                $developpeur,
                $developpeur->getPassword()
            )
        );
        $manager->persist($developpeur);
        $this->addReference('developpeur3', $developpeur);


        $resp = new ResponsableRH();
        $resp->setEmail("responsable@simpleduc.fr");
        $resp->setPassword("motdepasse");
        $resp->setRoles(array("ROLE_RESP", "ROLE_EMP"));
        $resp->setNom("NomRH");
        $resp->setPrenom("PrenomRH");
        $resp->setRIB("FR1765765995");
        $resp->setNombreHeures(34);
        $resp->setAdresse("4 rue du rh");
        $resp->setSexe("Femme");
        $resp->setPassword(
            $this->passwordHasher->hashPassword(
                $resp,
                $resp->getPassword()
            )
        );
        $this->addReference('responsable', $resp);
        $manager->persist($resp);

        $Employe = new Employe();
        $Employe->setEmail("employe@simpleduc.fr");
        $Employe->setPassword("motdepasse");
        $Employe->setRoles(array("ROLE_EMP"));
        $Employe->setNom("NomEmp");
        $Employe->setPrenom("PrenomEmp");
        $Employe->setRIB("FR1765675995");
        $Employe->setNombreHeures(35);
        $Employe->setAdresse("4 rue du emp");
        $Employe->setSexe("autres");
        $Employe->setPassword(
            $this->passwordHasher->hashPassword(
                $Employe,
                $Employe->getPassword()
            )
        );
        $manager->persist($Employe);
        

        $manager->flush();
    }
}
