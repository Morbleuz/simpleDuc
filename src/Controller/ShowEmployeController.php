<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employe;

class ShowEmployeController extends AbstractController
{
    #[Route('responsablerh/liste/employe', name: 'app_show_employe')]
    public function index(): Response
    {   
        $employes = $this->getDoctrine()->getRepository(Employe::class)->findAll();
        return $this->render('show_employe/index.html.twig', [
            'employes' => $employes
        ]);
    }
}
