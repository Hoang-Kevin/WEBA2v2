<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpClient\CurlHttpClient;
use App\Entity\Personnes;
use App\Entity\Produits;
use App\Entity\Activites;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


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

        return $this->render('main/home.html.twig', [
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
     *  @Route("/boutique/add"), name="boutique")
     */
    public function addboutique(Request $request) {
		
		//création d'un object produit vide
		$produit = new Produits();
		
		//paramètre du formulaire relier aux attributs de l'object produit
		$form = $this->createFormBuilder($produit)
					 ->add('nom', TextType::class)
					 ->add('description', TextareaType::class)
					 ->add('prix', MoneyType::class)
					 ->getForm();
					 
		//traite le formulaire
		$form->handleRequest($request);
					
		//dump = info dev		
		dump($produit);
		
		//si le formulaire a été soumis et est valide
		if($form->isSubmitted() && $form->isValid()) {
					
			//transforme en json les réponses du formulaire
			$login["data"]=json_encode($produit);
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
			
			//si connected dans $result prends la valeur true le produit est ajouté sinon il n'est pa ajouté
			if($result['connected']==TRUE) 
			{
				?>
				<script>alert("le produit est ajouté à la boutique !")</script>
				<?php
				header("Status: 301 Moved Permanently", false, 301);
				header('Location : /boutique');
				exit;
			}
			else
			{
				?>
				<script>alert("le produit ne c'est pas ajouté veuillez réssayer !")</script>
				<?php
			}
		}
					 
		//envoie le formulaire pour le construire sur la page web
        return $this->render('main/addproduit.html.twig', [
            'formAddProduit' => $form->createView()
		]);
    }
	
    /**
     *  @Route("/boutique/sup"), name="boutique")
     */
    public function supboutique(Request $request) {
		
		//création d'un object personne vide
		$produit = new Produits();
		
		//paramètre du formulaire relier aux attributs de l'object Personne
		$form = $this->createFormBuilder($produit)
					 ->add('nom', TextType::class)
					 ->getForm();
					 
		//traite le formulaire
		$form->handleRequest($request);
					
		//dump = info dev		
		dump($produit);
		
		//si le formulaire a été soumis et est valide
		if($form->isSubmitted() && $form->isValid()) {
					
			//transforme en json les réponses du formulaire
			$login["data"]=json_encode($produit);
			$url = 'htpp://localhost:3000/users';
			
			//ouverture de la connexion
			$open_co=curl_init();
			
			//configuration de l'envoie et envoie
			curl_setopt($open_co, CURLOPT_URL, $url);
			curl_setopt($open_co, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($open_co, CURLOPT_POSTFIELDS, $login);
			curl_setopt($open_co, CURLOPT_RETURNTRANSFER, true);
			
			//réponse
			$return = curl_exec($open_co);
			
			//fermeture de la connection
			curl_close($open_co);
			
			//décode le json 
			$result = json_decode($return);
			
			//si connected dans $result prends la valeur true le produit est supprmier sinon il n'est pas supprimer
			if($result['connected']==TRUE) 
			{
				?>
				<script>alert("le produit est supprimé de la boutique !")</script>
				<?php
				header("Status: 301 Moved Permanently", false, 301);
				header('Location : /boutique');
				exit;
			}
			else
			{
				?>
				<script>alert("le produit n'a pas été supprimé de la boutique !")</script>
				<?php
			}
		}
		
		//envoie le formulaire pour le construire sur la page web
        return $this->render('main/supproduit.html.twig', [
            'formSupProduit' => $form->createView()
		]);
    }

    /**
     *  @Route("/inscription"), name="inscription")
     */
    public function inscription(Request $request) {
		
		//création d'un object personne vide
		$personne = new Personnes();
		$encoders = [new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];
		$serializer = new Serializer($normalizers, $encoders);
		
		//paramètre du formulaire relier aux attributs de l'object Personne
		$form = $this->createFormBuilder($personne)
					 ->add('nom', TextType::class)
					 ->add('prenom', TextType::class)
					 ->add('localisation', TextType::class)
					 ->add('campus', TextType::class)
					 ->add('adressemail', EmailType::class)
					 ->add('motdepasse', PasswordType::class)
					 ->add('valide', CheckboxType::class, ['label' => "J'accepte les conditions du règlements"])
					 ->getForm();
		
		//traite le formulaire
		$form->handleRequest($request);
		
		//on crypte le mot de passe
		$personne->setMotdepasse(crypt($personne->getMotdepasse(), 'dkPOpjfiIsjni16/idjsdi:AZEIIjsdquIisdsji/1839'));	
		
		//dump = info dev		
		//var_dump($personne);
		
		//si le formulaire a été soumis et est valide
		if($form->isSubmitted() && $form->isValid()) {
					
			//transforme en json les réponses du formulaire
			$data = $form->getData();
			$json_data = $serializer->serialize($data, 'json');
			
			$url = 'http://localhost:3000/personnes?inscription=true';
			
			//ouverture de la connexion
			$open_co=curl_init();
			
			$header = [
				'Accept: application/json',
				'Content-Type: application/json'
			];

			dump($json_data);


			//configuration de l'envoie et envoie
			curl_setopt($open_co, CURLOPT_URL,$url );
			curl_setopt($open_co, CURLOPT_CUSTOMREQUEST, "POST");

			curl_setopt($open_co, CURLOPT_HTTPHEADER, $header);
			curl_setopt($open_co, CURLOPT_POSTFIELDS, $json_data);
			
			curl_setopt($open_co, CURLOPT_RETURNTRANSFER, true);

			//réponse
			$return = curl_exec($open_co);
			
			//fermeture de la connection
			curl_close($open_co);
			

			dump($return);
			$result = json_decode($return, true);
			
			//si connected dans $result prends la valeur true on est inscrit sinon on n'est pas inscrit 
			
			if($result['inscription'] == "Inscription reussie !") 
			{
				?>
				<script>alert("inscription réussi !")</script>
				<?php
				header("Status: 301 Moved Permanently", false, 301);
				header('Location : /connexion');
				exit;
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
     *  @Route("/evenement/new"), name="addevenement")
     */
    public function addevenement(Request $request) {

		$evenement = new Activites();
		$encoders = [new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];
		$serializer = new Serializer($normalizers, $encoders);

		$form = $this->createFormBuilder($evenement)
					 ->add('description', TextType::class)
					 ->add('image', TextType::class)
					 ->add('cout', CheckboxType::class)
					 ->add('recurrence', CheckboxType::class)
					 ->add('valide', CheckboxType::class)
					 ->getForm();

		$form->handleRequest($request);

		

		if($form->isSubmitted() && $form->isValid()) {
			$evenement->setDate(new \DateTime());
			$data = $form->getData();
			$json_data = $serializer->serialize($data, 'json');

			$url = 'http://localhost:3000/activites';

			$open_co=curl_init();

			$header = [
				'Accept: application/json',
				'Content-Type: application/json'
			];

			dump($json_data);

					
			//configuration de l'envoie et envoie
			curl_setopt($open_co, CURLOPT_URL,$url );
			curl_setopt($open_co, CURLOPT_CUSTOMREQUEST, "POST");
		
			curl_setopt($open_co, CURLOPT_HTTPHEADER, $header);
			curl_setopt($open_co, CURLOPT_POSTFIELDS, $json_data);						
						
			curl_setopt($open_co, CURLOPT_RETURNTRANSFER, true);
			
			$return = curl_exec($open_co);
			
			//fermeture de la connection
			curl_close($open_co);

			//décode le json 
			$result = json_decode($return);

			dump($result);
						
		}



        return $this->render('main/addevenement.html.twig', [
			'Title' => "Bonjour, bonjour",
			'formAddEvent' => $form->createView()
        ]);

    }


    /**
     *  @Route("/connexion"), name="connexion")
     */
    public function connexion(Request $request) {

		//$cookie = new Cookie('isconnected', 'false', strtotime('now + 10 minutes'));
		//création d'un object personne vide
		$personne = new Personnes();
		$encoders = [new JsonEncoder()];
		$normalizers = [new ObjectNormalizer()];
		$serializer = new Serializer($normalizers, $encoders);

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
			$data = $form->getData();
			$json_data = $serializer->serialize($data, 'json');
			$url = 'http://localhost:3000/personnes?connect=true';
			$header = [
				'Accept: application/json',
				'Content-Type: application/json'
			];
			
			dump($json_data);
			//ouverture de la connexion			
			$open_co = curl_init ();
			
			//configuration de l'envoie et envoie
			curl_setopt($open_co, CURLOPT_URL,$url );
			curl_setopt($open_co, CURLOPT_CUSTOMREQUEST, "POST");
		
			curl_setopt($open_co, CURLOPT_HTTPHEADER, $header);
			curl_setopt($open_co, CURLOPT_POSTFIELDS, $json_data);						
						
			curl_setopt($open_co, CURLOPT_RETURNTRANSFER, true);
			
			
			//réponse
			$return = curl_exec($open_co);	
			
			//décode le json 
			$result = json_decode($return, true);
			dump($result);
			
			//retourne si la connexion à réussi le token
			
			if($result['connect']==false){
				header("Status: 301 Moved Permanently", false, 301);
				header('Location : /connexion/error');
				exit;
			}
			else
			{
				header("Status: 301 Moved Permanently", false, 301);
				header('Location : /');
				exit;				
			}
			
		
		
			curl_close($open_co);		
		}

        return $this->render('main/connexion.html.twig', [
            'formConnexion' => $form->createView()
		]);
    }
    
    /**
     *  @Route("/connexion/error"), name="coerror")
     */
    public function coerror() {
        return $this->render('main/coerror.html.twig', [
            'Title' => "Bonjour, bonjour"


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
