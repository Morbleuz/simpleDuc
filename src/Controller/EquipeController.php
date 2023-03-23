<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\EquipeType;
use App\Entity\Equipe;
use Symfony\Component\HttpFoundation\Request;


class EquipeController extends AbstractController
{
    #[Route('/dev-equipe', name: 'app_equipe')]
    public function index(Request $request): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $developpeur = $form["developpeurs"]->getData();
                $em = $this->getDoctrine()->getManager();
                foreach($developpeur as $d){
                    $equipe->addDeveloppeur($d);
                    $d->addEquipe($equipe);
                    $em->persist($d);
                }
                $em->persist($equipe);
                $em->flush();
                $this->addFlash('notice', 'Equipe crée');
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('equipe/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
