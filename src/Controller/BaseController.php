<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Entity\Contact;
use App\Entity\Projet;
use App\Entity\Employe;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_base')]
    public function index(Request $request): Response
    {   

        $contact = new Contact();
        $form =  $this->createForm(ContactType::class,$contact);
        
        //Récupérer tout les employés
        $employes = $this->getDoctrine()->getRepository(Employe::class)->findAll();
        //Récupérer tout les projets 
        $projets = $this->getDoctrine()->getRepository(Projet::class)->findAll();
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
              
                $this->addFlash('notice', 'message envoyé');
                return $this->redirectToRoute('app_base');
            }
        }
        return $this->render('base/index.html.twig', [
            'form' => $form->createView(),
            'projets' => $projets,
            'employes' => $employes
        ]);
    }

    #[Route('/mention_legale', name: 'mention')]
    public function mentionlegales(): Response
    { 
        
        return $this->render('mentions_legales/mentionslegales.html.twig', [
        
        ]);
    }
    
}
