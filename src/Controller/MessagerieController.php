<?php

namespace App\Controller;

use App\Entity\Email;
use App\Entity\Employe;
use App\Entity\Reponse;
use App\Form\EmailType;
use App\Form\ReponseType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MessagerieController extends AbstractController
{
    #[Route('/messagerie', name: 'app_messagerie')]
    public function index(EntityManagerInterface $doctrine, Request $request): Response
    {
        $nombreEmailEnvoyer =$doctrine->getRepository(Employe::class)->GetNombreEmailEnvoyer();
        $nombreReponseEnvoyer = $doctrine->getRepository(Employe::class)->GetNombreReponseEnvoyer();
        $listeEmployer = $doctrine->getRepository(Employe::class)->findAll();
        $form = $this->createForm(EmailType::class);
        $email = new Email();
        //dump($nombreReponseEnvoyer);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $objet = $form->get('objet')->getData();
                $message = $form->get('message')->getData();

                $receiverID = $_POST["ReceiverID"];

                $receiver = $doctrine->getRepository(Employe::class)->find($receiverID);

                $email->setObjet($objet);
                $email->setMessage($message);
                $email->setSender($this->getUser());
                $email->setReceiver($receiver);

                $receiver->addReceiveEmail($email);
                $this->getUser()->addSendEmail($email);
                $doctrine->persist($email);
                $doctrine->persist($receiver);
                $doctrine->persist($this->getUser());
                $doctrine->flush();

                $this->addFlash('notice', 'Votre email est envoyé');
                return $this->redirectToRoute('app_messagerie');
            } else {
                $this->addFlash('warning', 'Votre email a pas était envoyé');
                return $this->redirectToRoute('app_messagerie');
            }
        }
        
        return $this->render('messagerie/index.html.twig', [
            "listeemployers" => $listeEmployer,
            'form' => $form->createView(),
            'nombreEmailEnvoyer' => $nombreEmailEnvoyer,
            'nombreReponseEnvoyer' => $nombreReponseEnvoyer
            
        ]);
    }
    #[Route('/messagerie/{id}', name: 'app_messagerieparid', requirements: ["id" => "\d+"])]
    public function emailbyid(EntityManagerInterface $doctrine, Request $request, int $id): Response
    {

        $email = $doctrine->getRepository(Email::class)->find($id);
        $formReponse = $this->createForm(ReponseType::class);
        $reponse = new Reponse();
        if ($request->isMethod('POST')) {
            $formReponse->handleRequest($request);
            if ($formReponse->isSubmitted() && $formReponse->isValid()) {
                $message = $formReponse->get('message')->getData();

                $reponse->setMessage($message);
                $reponse->setEmployer($this->getUser());
                $reponse->setEmail($email);

                $doctrine->persist($reponse);
                $doctrine->flush();
                
                return $this->redirectToRoute('app_messagerieparid', ['id' => $id]);

            }
        }
        return $this->render('messagerie/repondre-email.html.twig', [
            "email" => $email,
            'formReponse' => $formReponse->createView()
        ]);
    }

    #[Route('/messagerie-delete/{id}', name: 'app_removeEmail', requirements: ["id" => "\d+"])]
    public function removeEmail(EntityManagerInterface $doctrine, Request $request, int $id): Response
    {

        $email = $doctrine->getRepository(Email::class)->find($id);
        foreach($email->getReponses() as $reponse){
            $doctrine->remove($reponse);
        }
        $doctrine->remove($email);
        $doctrine->flush();
        return $this->redirectToRoute('app_messagerie'); 
    }
}
