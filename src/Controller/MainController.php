<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpClient\CurlHttpClient;
use App\Entity\Personnes;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{



    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     *  @Route("/"), name="home")
     */
    public function home() {

        $cookie = new Cookie('isconnected', 'false', strtotime('now + 10 minutes'));


        return $this->render('main/home.html.twig', [
            'cookie1' => $cookie->getValue('isconnected')
        ]);

    }

    /**
     *  @Route("/boutique"), name="boutique")
     */
    public function boutique() {
        return $this->render('main/boutique.html.twig', [
            'Title' => "Bonjour, bonjour",

        ]);

    }

    /**
     *  @Route("/inscription"), name="inscription")
     */
    public function inscription(Request $request) {
		
		//création d'un object personne vide
		$personne = new Personnes();
		
		//paramètre du formulaire relier aux attributs de l'object Personne
		$form = $this->createFormBuilder($personne)
					 ->add('nom', TextType::class)
					 ->add('prenom', TextType::class)
					 ->add('localisation', TextType::class)
					 ->add('campus', TextType::class)
					 ->add('adressemail', EmailType::class)
					 ->add('motdepasse', PasswordType::class)
					 ->getForm();
		
		//traite le formulaire
		$form->handleRequest($request);
		
		//on crypte le mot de passe
		$personne->setMotdepasse(crypt($personne->getMotdepasse(), 'dkPOpjfiIsjni16/idjsdi:AZEIIjsdquIisdsji/1839'));	
		
		//dump = info dev		
		dump($personne);
		
		//si le formulaire a été soumis et est valide
		if($form->isSubmitted() && $form->isValid()) {
					
			//transforme en json les réponses du formulaire
			$login["data"]=json_encode($personne);
			$url = 'htpp://localhost:3000/users';
			
			//ouverture de la connexion
			$open_co=curl_init();
			
			//configuration de l'envoie et envoie
			curl_setopt($open_co,CURLOPT_URL,$url); 
			curl_setopt($open_co,CURLOPT_POST,true);
			curl_setopt($open_co,CURLOPT_POSTFIELDS,$login);
			
			//réponse
			$return = curl_exec($open_co);
			
			//fermeture de la connection
			curl_close($open_co);
			
			//décode le json 
			$result = json_decode($return);
			
			//si connected dans $result prends la valeur true on est inscrit sinon on n'est pas inscrit 
			if($result['connected']==TRUE) 
			{
				?>
				<script>alert("inscription réussi !")</script>
				<?php
			}
			else
			{
				?>
				<script>alert("inscription echouée !")</script>
				<?php
			}
		}
		
		//envoie le formulaire pour le construire sur la page web
        return $this->render('main/inscription.html.twig', [
            'formInscription' => $form->createView()
		]);
    }

    /**
     *  @Route("/evenement"), name="evenement")
     */
    public function evenement() {
        return $this->render('main/evenement.html.twig', [
            'Title' => "Bonjour, bonjour"


        ]);

    }


    /**
     *  @Route("/connexion"), name="connexion")
     */
    public function connexion(Request $request) {
		//création d'un object personne vide
		$personne = new Personnes();

		//paramètre du formulaire relier aux attributs de l'object Personne
		$form = $this->createFormBuilder($personne)
					 ->add('adressemail', EmailType::class)
					 ->add('motdepasse', PasswordType::class)
					 ->getForm();

		//traite le formulaire
		$form->handleRequest($request);

		//On crypte le mot de passe
		$personne->setMotdepasse(crypt($personne->getMotdepasse(), 'dkPOpjfiIsjni16/idjsdi:AZEIIjsdquIisdsji/1839'));
		
		//Si le formulaire a été soumis et est valide
		if($form->isSubmitted() && $form->isValid()) {
			
			//transforme en json les réponses du formulaire
			$login["data"]=json_encode($personne);
			$url = 'htpp://localhost:3000/users';
			
			//ouverture de la connexion			
			$open_co = curl_init ();
			
			//configuration de l'envoie et envoie
			curl_setopt($open_co,CURLOPT_URL,$url);
			curl_setopt($open_co, CURLOPT_POST, true);
			curl_setopt($open_co,CURLOPT_POSTFIELDS,$login);
			curl_setopt($open_co, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($open_co, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			
			//réponse
			$return = curl_exec($open_co);	
			
			//décode le json 
			$result = json_decode($return);
			
			//retourne si la connexion à réussi le token
			if(!$result){die("Error : Connection Echoué !");}
			curl_close($curl);		
		}

        return $this->render('main/connexion.html.twig', [
            'formConnexion' => $form->createView()
		]);
    }
	
        /**
     *  @Route("/mentions"), name="mentions")
     */
    public function mentions() {
        return $this->render('main/mentions.html.twig', [
            'Title' => "Bonjour, bonjour"


        ]);

    }

        /**
     *  @Route("/pdc"), name="pdc")
     */
    public function pdc() {
        return $this->render('main/pdc.html.twig', [
            'Title' => "Bonjour, bonjour"


        ]);

    }

        /**
     *  @Route("/cgv"), name="cgv")
     */
    public function cgv() {
        return $this->render('main/cgv.html.twig', [
            'Title' => "Bonjour, bonjour"


        ]);

    }

}
