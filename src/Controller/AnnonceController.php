<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CreateannonceType;
use App\Entity\Annonce;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

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
    public function listeannonce(Request $request,EntityManagerInterface $entityManager): Response
    {

        $repoannonce = $entityManager->getRepository(Annonce::class);
        $listeannonce = $repoannonce->findAll();
        return $this->render('annonce/liste-annonce.html.twig', [
            "annonces" => $listeannonce
        ]);
    }
}
