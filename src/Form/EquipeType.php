<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Developpeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Constraints\Count;


class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {    
        $builder
            ->add('NomEquipe', TextType::class,[
                'label'=>'Nom de l\'équipe',
                'attr' => ['class'=> 'w3-input w3-border'],
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 50, 
                        'minMessage' => 'Le nom du projet doit avoir au minimum 5 caractères',
                        'maxMessage' => 'Le nom du projet doit avoir au maximum 50 caractères'
                        ])], 

                ])
            ->add('developpeurs',  EntityType::class, [
                'label' => 'Les développeurs de l\'équipe',
                'class' => Developpeur::class,
                'multiple' => true,
                'expanded' => true,
                'constraints' => [
                    new Count([
                        'min' => 2,
                        'minMessage' => "Une équipe doit contenir au moins 2 développeurs"
                ])],
                'choice_label' => 'email',
            ])
            ->add('envoyer', SubmitType::class,['label'=> 'Envoyer', 'attr' => ['class'=> 'w3-button w3-black w3-section']])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
