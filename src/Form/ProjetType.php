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


class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomProjet', TextType::class, ['label'=>'Nom du projet'])
            ->add('CoutTotalEstime', IntegerType::class,['label'=>'Cout total estimé'])
            ->add('equipe',  EntityType::class, [
                'label' => 'Choissisez une équipe pour le projet',
                'class' => Equipe::class,
                'expanded' => true,
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
