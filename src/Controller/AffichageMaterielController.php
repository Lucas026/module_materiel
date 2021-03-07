<?php

namespace App\Controller;

use App\Entity\Materiel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class AffichageMaterielController extends Controller
{
    /**
     * @Route("/materiel", name="affichage_materiel")
     */   
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Materiel::class);

        $materiel = $repository->findAll();
                
        return $this->render('affichage_materiel/index.html.twig', [
            'materiel' => $materiel
          
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {     
        return $this->render('affichage_materiel/home.html.twig');
    }

    /**
     * @Route("/materiel/modification/{id}", name="materiel_formulaire")
     */
    public function formulaire(Request $request, ObjectManager $manager, Materiel $materiel)
    {       
        $form = $this->createFormBuilder($materiel)
                    ->add('Nom_Materiel')
                    ->add('Prix_Materiel')
                    ->add('Quantite_Materiel')
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $materiel->setDateCreationMateriel(new \DateTime());

            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            return $this->redirectToRoute('affichage_materiel');
        }

        return $this->render('affichage_materiel/formulaire.html.twig', [
            'formMateriel' => $form->createView()
        ]);
    }

    /**
     * @Route("/materiel/ajout", name="materiel_ajout")
     */
    public function ajout(Request $request, ObjectManager $manager)
    {       
        $materiel = new Materiel();

        $form = $this->createFormBuilder($materiel)
                    ->add('Nom_Materiel')
                    ->add('Prix_Materiel')
                    ->add('Quantite_Materiel')
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $materiel->setDateCreationMateriel(new \DateTime());

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($materiel);
            $manager->flush();

            return $this->redirectToRoute('affichage_materiel', ['id' => $materiel->getId()]);
        }

        return $this->render('affichage_materiel/formulaire.html.twig', [
            'formMateriel' => $form->createView()
        ]);
    }

    /**
     * @Route("/materiel/{id}", name="modal_materiel")
     */    
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Materiel::class);

        $info = $repository->find($id);
        
        return $this->render('affichage_materiel/modal.html.twig', [
            'materiels' => $info
        ]);
    }
    
    
}
