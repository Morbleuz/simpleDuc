<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EmployeModifType;
use Symfony\Component\HttpFoundation\Request;


class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(EmployeModifType::class, $this->getUser());
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em = $this->getDoctrine()->getManager();
                //$user->setEmail($form->get("email")->getData());
                $em->persist($this->getUser());
                $em->flush();
            }
        }
        
        return $this->render('profil/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
