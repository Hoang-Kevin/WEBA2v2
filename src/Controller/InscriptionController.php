<?php

namespace App\Controller;

use OC\PlatformBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

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

    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('main/inscription.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}