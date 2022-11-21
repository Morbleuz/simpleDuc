<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

use App\Entity\Employe;
use App\Entity\User;
use App\Entity\ResponsableRH;
use App\Entity\Developpeur;


use App\Form\EmployeType;
use App\Form\DeveloppeurType;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AjoutEmployeController extends AbstractController
{   

    //Generate random password
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

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
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher,MailerInterface $mailer): Response
    {
        //On vérifie si l'utilisateur connecté est un employe RH
        $this->checkIfIsEmployeRH();


        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);


        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $password = $this->randomPassword();
                $employe->setPassword(
                    $userPasswordHasher->hashPassword(
                        $employe,
                        $password
                    )
                );

                $email = (new Email())
                ->from('simpleduc@no-reply.fr')
                ->to($employe->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Création de vôtre compte !')
                ->html('<p>Vôtre mot de pass est <strong>"'.$password.'"</strong> !</p>');
    
                $mailer->send($email);


                $em = $this->getDoctrine()->getManager();
               
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
    public function employerh(Request $request, UserPasswordHasherInterface $userPasswordHasher,MailerInterface $mailer): Response
    {
        $employe = new ResponsableRH();
        $form = $this->createForm(EmployeType::class, $employe);


        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $email = (new Email())
                ->from('simpleduc@no-reply.fr')
                ->to($employe->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Création de vôtre compte !')
                ->text('text')
                ->html('<p>See Twig integration for better HTML integration!</p>');
    
                $mailer->send($email);
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

    #[Route('/ajout/developpeur', name: 'app_ajout_developpeur')]
    public function developpeur(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $developpeur = new Developpeur();
        $form = $this->createForm(DeveloppeurType::class, $developpeur);


        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $developpeur->setPassword(
                    $userPasswordHasher->hashPassword(
                        $employe,
                        $form->get('password')->getData()
                    )
                );
                //$user->setEmail($form->get("email")->getData());
                $em->persist($developpeur);
                $em->flush();
            }
        }
        
        return $this->render('ajout_employe/developpeur.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
