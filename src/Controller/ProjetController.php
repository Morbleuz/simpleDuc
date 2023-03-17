<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProjetType;
use App\Entity\Projet;


class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'app_projet')]
    public function index(): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);

        return $this->render('projet/index.html.twig', [
            'form' => $form->createView()


        ]);
    }
}
