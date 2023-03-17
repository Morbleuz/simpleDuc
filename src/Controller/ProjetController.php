<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProjetType;
use App\Entity\Projet;

use Symfony\Component\HttpFoundation\Request;



class ProjetController extends AbstractController
{
    #[Route('/dev-projet', name: 'app_projet')]
    public function index(Request $request): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $projet->setCoutReel(0);
        
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($projet);
                $em->flush();

                $this->addFlash('notice', 'Projet créer');
                $this->redirectToRoute('app_login');

            }
        }
        return $this->render('projet/index.html.twig', [
            'form' => $form->createView()


        ]);
    }

        #[Route('/dev-projet/{id}', name: 'app_un_projet', requirements: ['id' => '\d+'])]
        public function unprojet(Request $request, int $id): Response
        {
            $projet = $this->getDoctrine()->getRepository(Projet::class)->find($id);
            return $this->render('projet/unprojet.html.twig', [
                'projet' => $projet
            ]);
        }
}

