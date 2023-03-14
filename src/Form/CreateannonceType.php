<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class CreateannonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Nom', TextType::class,['label'=> "Nom de l'annonce", 'attr' => ['class'=> 'w3-input w3-border', 'placeholder' => '']])
        ->add('Post', TextType::class,['label'=> "Intitulé du poste", 'attr' => ['class'=> 'w3-input w3-border', 'placeholder' => '']])
        ->add('Salaire', IntegerType::class,['label'=> "Salaire", 'attr' => ['class'=> ' w3-input w3-border', 'placeholder' => '']])
        ->add('Qualification', TextType::class,['label'=> "Qualification", 'attr' => ['class'=> 'w3-input w3-border', 'placeholder' => '']])
        ->add('Description', TextAreaType::class,['label'=> "Description du poste", 'attr' => ['class'=> ' w3-input w3-border', 'placeholder' => '']])
        ->add('envoyer', SubmitType::class,['label'=> 'Envoyer', 'attr' => ['class'=> 'w3-btn w3-black w3-margin-top w3-round w3-large']] )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
