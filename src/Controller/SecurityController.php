<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\SecurityType;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends AbstractController
{
    #[Route(path: '/backoffice', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {   
        $form = $this->createForm(SecurityType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        }

        if($this->getUser()){
            dump($this->getUser());
        }


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
