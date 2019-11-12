<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\CurlHttpClient;

class InscriptionController extends AbstractController
{
  public function addAction(Request $request)
  {
    // On crée un objet Personne
    $personne = new Personne();

    // On crée le FormBuilder grâce au service form factory
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $personne);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      ->add('identifiant',      TextType::class)
      ->add('nom',     TextType::class)
      ->add('prenom',   TextType::class)
      ->add('localisation',    TextType::class)
      ->add('campus', TextType::class)
	  ->add('adresse email', EmailType::class)
	  ->add('mot de passe', PasswordType::class)
      ->add('valider',      SubmitType::class)
    ;
	
    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();
	
	// Si la requête est en POST
    if ($request->isMethod('POST')) {
		// On fait le lien Requête <-> Formulaire
		// À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
		$form->handleRequest($request);	
		// On vérifie que les valeurs entrées sont correctes
		if ($form->isValid()) {
			$login["data"]=json_encode($personne,FORCE_JSON_OBJECT);
			$url = 'htpp://localhost:3000/users';
		
			//On ouvre une connexion avec l'API
			$open_co=curl_init();
		
			curl_setopt($open_co,CURLOPT_URL,$url); 
			curl_setopt($open_co,CURLOPT_POST,true);
			curl_setopt($open_co,CURLOPT_POSTFIELDS,$login);
		
			$return = curl_exec($open_co);
		
			//On ferme la connexion 
			curl_close($open_co);
		
			$result = json_decode($return);
			
			return $result;
		}
	}
	
    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('main/inscription.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}