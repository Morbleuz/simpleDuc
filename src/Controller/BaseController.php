<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_base')]
    public function index(): Response
    {
        $form =  $this->createForm(ContactType::class);
        
        return $this->render('base/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/ml', name: 'mention')]
    public function ml(): Response
    { 
        return $this->render('mentions_legales/mentionslegales.html.twig', [
        ]);
    }
    
}
