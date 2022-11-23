<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CreateannonceType;

class AnnonceController extends AbstractController
{
    #[Route('/annonce', name: 'app_annonce')]
    public function index(): Response
    {
        $form = $this->createForm(CreateannonceType::class);

        return $this->render('annonce/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
