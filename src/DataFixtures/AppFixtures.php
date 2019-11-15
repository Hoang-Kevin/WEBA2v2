<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Personnes;
use App\Entity\Roles;
use App\Entity\Activites;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		$role = new Roles();
		$role->setRole('Etudiant');
		$manager->persist($role);
		
		$personne = new Personnes();
		$personne->setIdRole($role);
		$personne->setNom('Flantier');
		$personne->setPrenom('Noël');
		$personne->setLocalisation('14 Avenue Willy Brant 59000 Lille');
		$personne->setCampus('Lille');
		$personne->setAdressemail('noel.flantier@viacesi.fr');
		$personne->setMotdepasse(crypt('FLANTIER18', 'dkPOpjfiIsjni16/idjsdi:AZEIIjsdquIisdsji/1839'));
		$personne->setValide('TRUE');
		$manager->persist($personne);
			
		$activite = new Activites;
		$activite->setIdPersonne($personne);
		$activite->setDescription('Foot salle chaque jeudi après-midi');
		$activite->setImage('foot.jpg');
		$activite->setDate(new \DateTime('2019/11/22'));
		$activite->setCout('TRUE');
		$activite->setRecurrence('TRUE');
		$activite->setValide('TRUE');
		$activite->setNom('Foot salle');
		$manager->persist($activite);
		
		$role = new Roles();
		$role->setRole('BDE');
		$manager->persist($role);

		$personne = new Personnes();
		$personne->setIdRole($role);
		$personne->setNom('Michel');
		$personne->setPrenom('Bruel');
		$personne->setLocalisation('125 rue des Champs Elysée 75000 Paris');
		$personne->setCampus('Nanterre');
		$personne->setAdressemail('michel.bruel@viacesi.fr');
		$personne->setMotdepasse(crypt('AimeLaMusique1990', 'dkPOpjfiIsjni16/idjsdi:AZEIIjsdquIisdsji/1839'));
		$personne->setValide('TRUE');
		$manager->persist($personne);

		$activite = new Activites;
		$activite->setIdPersonne($personne);
		$activite->setDescription('LAN de jeux vidéos lors de la journée de vendredi avec entrée à 3€');
		$activite->setImage('jdr.png');
		$activite->setDate(new \DateTime('2019/11/22'));
		$activite->setCout('TRUE');
		$activite->setRecurrence('FALSE');
		$activite->setValide('TRUE');
		$activite->setNom('LAN');
		$manager->persist($activite);
		
		$role = new Roles();
		$role->setRole('CESI');
		$manager->persist($role);	
		
		$personne = new Personnes();
		$personne->setIdRole($role);
		$personne->setNom('John');
		$personne->setPrenom('Wick');
		$personne->setLocalisation('67 boulevard du Vieux Port 13000');
		$personne->setCampus('Aix en Provence');
		$personne->setAdressemail('john.wick@viacesi.fr');
		$personne->setMotdepasse(crypt('CrayonDeBois68', 'dkPOpjfiIsjni16/idjsdi:AZEIIjsdquIisdsji/1839'));
		$personne->setValide('TRUE');
		$manager->persist($personne);
		
		$activite = new Activites;
		$activite->setIdPersonne($personne);
		$activite->setDescription('Jeux de rôle sur table Stellaris le jeudi après midi une fois par mois');
		$activite->setImage('LAN.jpg');
		$activite->setDate(new \DateTime('2019/11/22'));
		$activite->setCout('FALSE');
		$activite->setRecurrence('TRUE');
		$activite->setValide('TRUE');
		$activite->setNom('Jeux de rôle sur table');
		$manager->persist($activite);
		
        $manager->flush();
    }
}
