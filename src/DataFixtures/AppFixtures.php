<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Personnes;
use App\Entity\Roles;
use App\Entity\Activites;
use App\Entity\Categories;
use App\Entity\Commandes;
use App\Entity\Photos;
use App\Entity\Commenters;
use App\Entity\Inscrires;
use App\Entity\Produits;
use App\Entity\Stockers;
use App\Entity\Voters;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		//Premières Champs
		$role = new Roles();
		$role->setRole('Etudiant');
		$manager->persist($role);
		
		$categorie = new Categories();
		$categorie->setCategorie('Vêtement');
		$manager->persist($categorie);
		
		$produit = new Produits();
		$produit->setIdCategorie($categorie);
		$produit->setNom('Pull Cesi');
		$produit->setDescription('Pull Cesi 100% coton floqué avec les emblêmes du Cesi');
		$produit->setPrix('35');
		$produit->setimage('"https://via.placeholder.com/300x150"');
		$manager->persist($produit);

		$produit = new Produits();
		$produit->setIdCategorie($categorie);
		$produit->setNom('Polo Cesi');
		$produit->setDescription('Polo Cesi 100% coton floqué avec les emblêmes du Cesi');
		$produit->setPrix('20');
		$produit->setimage('"https://via.placeholder.com/300x150"');
		$manager->persist($produit);
		
		$produit = new Produits();
		$produit->setIdCategorie($categorie);
		$produit->setNom('T-shirt Wild Box');
		$produit->setDescription('T-shirt Wild Box 100% coton floqué avec les emblêmes personnalisés des avatars Wild Box');
		$produit->setPrix('25');
		$produit->setimage('"https://via.placeholder.com/300x150"');
		$manager->persist($produit);
		
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
		
		$commande = new Commandes();
		$commande->setIdPersonne($personne);
		$commande->setValide('TRUE');
		$manager->persist($commande);
		
		$stocker = new Stockers();
		$stocker->setIdProduit($produit);
		$stocker->setIdCommande($commande);
		$stocker->setQuantite('1');		
		$manager->persist($stocker);
		
		$activite = new Activites();
		$activite->setIdPersonne($personne);
		$activite->setDescription('Foot salle chaque jeudi après-midi');
		$activite->setImage('"https://via.placeholder.com/300x150"');
		$activite->setDate(new \DateTime('2019/11/22'));
		$activite->setCout('TRUE');
		$activite->setRecurrence('TRUE');
		$activite->setValide('TRUE');
		$activite->setNom('Foot salle');
		$manager->persist($activite);

		$inscrire = new Inscrires();
		$inscrire->setIdActivite($activite);
		$inscrire->setIdPersonne($personne);
		$manager->persist($inscrire);
		
		$voter = new Voters();
		$voter->setIdActivite($activite);
		$voter->setIdPersonne($personne);
		$manager->persist($voter);

		$photo = new Photos();
		$photo->setIdActivite($activite);
		$photo->setIdPersonne($personne);
		$manager->persist($photo);
		
		//Deuxièmes Champs
		$role = new Roles();
		$role->setRole('BDE');
		$manager->persist($role);
		
		$categorie = new Categories();
		$categorie->setCategorie('Goodies');
		$manager->persist($categorie);

		$produit = new Produits();
		$produit->setIdCategorie($categorie);
		$produit->setNom('Casquet Cesi');
		$produit->setDescription('Casquet Cesi 100% coton floqué avec les emblêmes du Cesi');
		$produit->setPrix('10');
		$produit->setimage('"https://via.placeholder.com/300x150"');
		$manager->persist($produit);
		
		$produit = new Produits();
		$produit->setIdCategorie($categorie);
		$produit->setNom('Bonnet Cesi');
		$produit->setDescription('Bonnet Cesi 100% coton floqué avec les emblêmes du Cesi');
		$produit->setPrix('15');
		$produit->setimage('"https://via.placeholder.com/300x150"');
		$manager->persist($produit);
		
		$produit = new Produits();
		$produit->setIdCategorie($categorie);
		$produit->setNom('Bob Cesi');
		$produit->setDescription('Bob Cesi 100% coton floqué avec les emblêmes du Cesi');
		$produit->setPrix('20');
		$produit->setimage('"https://via.placeholder.com/300x150"');
		$manager->persist($produit);

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

		$activite = new Activites();
		$activite->setIdPersonne($personne);
		$activite->setDescription('LAN de jeux vidéos lors de la journée de vendredi avec entrée à 3€');
		$activite->setImage('"https://via.placeholder.com/300x150"');
		$activite->setDate(new \DateTime('2019/11/22'));
		$activite->setCout('TRUE');
		$activite->setRecurrence('FALSE');
		$activite->setValide('TRUE');
		$activite->setNom('LAN');
		$manager->persist($activite);

		$inscrire = new Inscrires();
		$inscrire->setIdActivite($activite);
		$inscrire->setIdPersonne($personne);
		$manager->persist($inscrire);
		
		$voter = new Voters();
		$voter->setIdActivite($activite);
		$voter->setIdPersonne($personne);
		$manager->persist($voter);
		
		$photo = new Photos();
		$photo->setIdActivite($activite);
		$photo->setIdPersonne($personne);
		$manager->persist($photo);
		
		$commentaire = new Commenters();
		$commentaire->setIdPhoto($photo);
		$commentaire->setIdPersonne($personne);
		$commentaire->setCommentaire('ça va être trop fun XD');
		$manager->persist($commentaire);
		
		//Troisièmes Champs
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
		
		$commande = new Commandes();
		$commande->setIdPersonne($personne);
		$commande->setValide('TRUE');
		$manager->persist($commande);

		$stocker = new Stockers();
		$stocker->setIdProduit($produit);
		$stocker->setIdCommande($commande);
		$stocker->setQuantite('2');		
		$manager->persist($stocker);
		
		$activite = new Activites;
		$activite->setIdPersonne($personne);
		$activite->setDescription('Jeux de rôle sur table Stellaris le jeudi après midi une fois par mois');
		$activite->setImage('"https://via.placeholder.com/300x150"');
		$activite->setDate(new \DateTime('2019/11/22'));
		$activite->setCout('FALSE');
		$activite->setRecurrence('TRUE');
		$activite->setValide('TRUE');
		$activite->setNom('Jeux de rôle sur table');
		$manager->persist($activite);
		
		$inscrire = new Inscrires();
		$inscrire->setIdActivite($activite);
		$inscrire->setIdPersonne($personne);
		$manager->persist($inscrire);
		
		$voter = new Voters();
		$voter->setIdActivite($activite);
		$voter->setIdPersonne($personne);
		$manager->persist($voter);
		
		$photo = new Photos();
		$photo->setIdActivite($activite);
		$photo->setIdPersonne($personne);
		$manager->persist($photo);
		
        $manager->flush();
    }
}
