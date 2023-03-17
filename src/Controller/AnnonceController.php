<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CreateannonceType;
use App\Entity\Annonce;
use App\Entity\Candidat;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PostuleAnnonceType;
class AnnonceController extends AbstractController
{
    #[Route('/responsablerh-annonce', name: 'app_annonce')]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CreateannonceType::class);
        $annonce = new Annonce();
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){


                $titre=$form->get('Nom')->getData();
                $poste=$form->get('Post')->getData();
                $salaire=$form->get('Salaire')->getData();
                $qualification=$form->get('Qualification')->getData();
                $description=$form->get('Description')->getData();

                $annonce->setNomAnnonce($titre);
                $annonce->setPosteAPromouvoir($poste);
                $annonce->setSalaireDeBase( $salaire);
                $annonce->setQualification($qualification);
                $annonce->setDescription($description);
                $annonce->setResponsableRH($this->getUser());

                $entityManager->persist($annonce);
                $entityManager->flush();                
                
                $this->addFlash('notice','Votre annonce est envoyé');
                return $this->redirectToRoute('app_annonce');

            }
        }
        
        return $this->render('annonce/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/liste-annonce', name: 'app_liste-annonce')]
    public function listeannonce(Request $request,EntityManagerInterface $doctrine): Response
    {
        $formCandidat = $this->createForm(PostuleAnnonceType::class);
        $repoannonce = $doctrine->getRepository(Annonce::class);
        $listeannonce = $repoannonce->findAll();

        

        $candidat = new Candidat();

        if($request->isMethod('POST')){
            $formCandidat->handleRequest($request);
            if ($formCandidat->isSubmitted()&&$formCandidat->isValid()){
               
                $email=$formCandidat->get('email')->getData();
                $nom=$formCandidat->get('nom')->getData();
                $prenom=$formCandidat->get('prenom')->getData();

                $annonceID=$_POST["annonceID"];
                $Annonce = $doctrine->getRepository(Annonce::class)->find($annonceID);
                $candidat->setEmail($email);
                $candidat->setNom($nom);
                $candidat->setPrenom($prenom);
                $candidat->setAnnonce($Annonce);

                $doctrine->persist($candidat);
                $doctrine->flush();   
                                
                $this->addFlash('notice','Votre candidature est envoyé');
                return $this->redirectToRoute('app_liste-annonce');
            }
        }

        return $this->render('annonce/liste-annonce.html.twig', [
            "form" => $formCandidat->createView(),
            "annonces" => $listeannonce
        ]);
    }
}
