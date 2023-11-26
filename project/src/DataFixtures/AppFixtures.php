<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Fournisseur;
use App\Entity\Facture;
use App\Entity\Secteur;
use App\Entity\FournisseurHasSecteur;
use App\Entity\StationEssence;
use App\Entity\UserHasFacture;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Peupler la table User
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setNom($faker->lastName);
            $user->setPrenom($faker->firstName);
            $user->setPassword($faker->password);
            $user->setEmail($faker->email);
            $user->setAdresse($faker->address);
            $user->setMobile($faker->phoneNumber);
            $manager->persist($user);
        }

        // Peupler la table Fournisseur
        for ($i = 0; $i < 5; $i++) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNom($faker->lastName);
            $fournisseur->setPrenom($faker->firstName);
            $fournisseur->setAdresse($faker->address);
            $fournisseur->setSiren($faker->ean8);
            $fournisseur->setNomEntreprise($faker->company);
            $manager->persist($fournisseur);
        }

        // Ajoutez des sections, fournisseurs_has_secteur, stations_essence, et user_has_facture selon le même modèle

        $manager->flush();
    }
}
