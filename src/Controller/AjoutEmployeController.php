<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Employe;
use App\Entity\User;
use App\Entity\ResponsableRH;

use App\Form\EmployeType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AjoutEmployeController extends AbstractController
{   

    function checkIfIsEmployeRH()
    {
        //Vérification de l'employe
        if($this->getUser() == null){
            return $this->redirectToRoute('app_base');
        }else{
            if(!$this->getUser() instanceof ResponsableRH){
                return $this->redirectToRoute('app_base');
            }
        }
    }

    #[Route('/ajout/employe', name: 'app_ajout_employe')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        //On vérifie si l'utilisateur connecté est un employe RH
        $this->checkIfIsEmployeRH();


        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);


        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $employe->setPassword(
                    $userPasswordHasher->hashPassword(
                        $employe,
                        $form->get('password')->getData()
                    )
                );
                //$user->setEmail($form->get("email")->getData());
                $em->persist($employe);
                $em->flush();
            }
        }
        
        return $this->render('ajout_employe/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/ajout/employerh', name: 'app_ajout_employerh')]
    public function employerh(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $employe = new ResponsableRH();
        $form = $this->createForm(EmployeType::class, $employe);


        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $employe->setPassword(
                    $userPasswordHasher->hashPassword(
                        $employe,
                        $form->get('password')->getData()
                    )
                );
                //$user->setEmail($form->get("email")->getData());
                $em->persist($employe);
                $em->flush();
            }
        }
        
        return $this->render('ajout_employe/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
