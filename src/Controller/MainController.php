<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Doctrine\Common\Persistence\ObjectManager;
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
    public function inscription(Request $resquest, ObjectManager $manager) {
		
		//création d'un object personne vide
		$personne = new Personne();
		
		//
		$form = $this->createFormBuilder($personne)
					 ->add('nom', TextType::class, [
							'attr'=>[
								'placeholder'=>"Flantier"
							]
						])
					 ->add('prenom', TextType::class, [
							'attr'=>[
								'placeholder'=>"Noël"
							]
						])
					 ->add('localisation', TextType::class, [
							'attr'=>[
								'placeholder'=>"Roubaix"
							]
						])
					 ->add('campus', TextType::class, [
							'attr'=>[
								'placeholder'=>"Lille"
							]
						])
					 ->add('adressemail', EmailType::class, [
							'attr'=>[
								'placeholder'=>"noel.flantier@viacesi.fr"
							]
						])
					 ->add('password', PasswordType::class, [
							'attr'=>[
								'placeholder'=>"IUhjdq90"
							]
						])
					 ->getForm();
		
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
}
