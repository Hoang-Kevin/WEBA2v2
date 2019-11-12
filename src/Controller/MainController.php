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
use App\Entity\Personne;

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
            'Title' => "Bonjour, bonjour"


        ]);

    }

    /**
     *  @Route("/boutique"), name="boutique")
     */
    public function boutique() {
        return $this->render('main/boutique.html.twig', [
            'Title' => "Bonjour, bonjour"


        ]);

    }

    /**
     *  @Route("/inscription"), name="inscription")
     */
    public function inscription(Request $request) {
		
		//création d'un object personne vide
		$personne = new Personne();
		
		$form = $this->createFormBuilder($personne)
					 ->add('nom', TextType::class)
					 ->add('prenom', TextType::class)
					 ->add('localisation', TextType::class)
					 ->add('campus', TextType::class)
					 ->add('adressemail', EmailType::class)
					 ->add('motdepasse', PasswordType::class)
					 ->getForm();
					 
		$form->handleRequest($request);
			
		dump($personne);
		
		if($form->isSubmitted() && $form->isValid()) {
					
			$login["data"]=json_encode($personne);
			$url = 'htpp://localhost:3000/users';
			
			$open_co=curl_init();
			
			curl_setopt($open_co,CURLOPT_URL,$url); 
			curl_setopt($open_co,CURLOPT_POST,true);
			curl_setopt($open_co,CURLOPT_POSTFIELDS,$login);
			
			$return = curl_exec($open_co);
			
			curl_close($open_co);
			
			$result = json_decode($return);
			
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
    public function connexion() {
        return $this->render('main/connexion.html.twig', [
            'Title' => "Bonjour, bonjour"


        ]);

    }
}
