<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EquipeType;
use App\Entity\Equipe;

class EquipeController extends AbstractController
{
    #[Route('/equipe', name: 'app_equipe')]
    public function index(): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);

        return $this->render('equipe/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
