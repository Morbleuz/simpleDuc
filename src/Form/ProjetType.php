<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Equipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\GreaterThan;


class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomProjet', TextType::class, [
                'label'=>'Nom du projet',
                'required' => true,
                'attr' => ['class'=> 'w3-input w3-border'], 
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 50, 
                        'minMessage' => 'Le nom du projet doit avoir au minimum 5 caractères',
                        'maxMessage' => 'Le nom du projet doit avoir au maximun 50 caractères'
                        ])]
            ])
            ->add('CoutTotalEstime', IntegerType::class,[
                'label'=>'Coût total estimé',
                'attr' => ['class'=> 'w3-input w3-border'], 
                'required' => true,
                'constraints' => [
                    new GreaterThan([
                        'value' => 100,
                        'message' => 'Le coût  total doit être supérieur à 100€'
                        ])]

                    

                ])
            ->add('equipe',  EntityType::class, [
                'label' => 'Choissisez une équipe pour le projet',
                'class' => Equipe::class,
                'expanded' => true,
                'required' => true,
                'choice_label' => 'nomEquipe',
            ])
            ->add('envoyer', SubmitType::class,['label'=> 'Envoyer', 'attr' => ['class'=> 'w3-button w3-black w3-section']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
