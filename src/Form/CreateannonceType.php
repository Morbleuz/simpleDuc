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
        ->add('Nom', TextType::class,['label'=> false, 'attr' => ['class'=> 'w3-section w3-input w3-border', 'placeholder' => 'Titre de l\'annonce']])
        ->add('Post', TextType::class,['label'=> false, 'attr' => ['class'=> 'w3-section w3-input w3-border', 'placeholder' => 'Poste a Promouvoir']])
        ->add('Salaire', IntegerType::class,['label'=> false, 'attr' => ['class'=> 'w3-section w3-input w3-border', 'placeholder' => 'Salaire De Base']])
        ->add('Qualification', TextType::class,['label'=> false, 'attr' => ['class'=> 'w3-section w3-input w3-border', 'placeholder' => 'Qualification']])
        ->add('Description', TextAreaType::class,['label'=> false, 'attr' => ['class'=> 'w3-section w3-input w3-border', 'placeholder' => 'Description']])
        ->add('envoyer', SubmitType::class,['label'=> 'Envoyer', 'attr' => ['class'=> 'w3-button w3-black w3-section']] )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
