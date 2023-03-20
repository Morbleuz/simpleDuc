<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\SecurityType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Developpeur;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    #[Route(path: '/backoffice', name: 'app_login')]
    public function login(EntityManagerInterface $doctrine,Request $request, AuthenticationUtils $authenticationUtils): Response
    {   
        $form = $this->createForm(SecurityType::class);
        $form->handleRequest($request);
        //$projets = $this->getDoctrine()->getRepository(Developpeur::class)->getProjet($this->getUser());
        //$projets = $this->getUser()->getEquipes();
        //$projets = $doctrine->getRepository(Developpeur::class)->getProjet(3);
        //dump($projets);
        if ($form->isSubmitted() && $form->isValid()) {
        }
        $user =$this->getUser();
        $projets = null;
        if($user instanceof Developpeur){
            $projets = $this->getDoctrine()->getRepository(Developpeur::class)->getProjet($user->getId());
        }
        dump($projets);
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'loginForm' => $form->createView()
        ]);

        
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): Response
    {   
        
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
        
    }
}
