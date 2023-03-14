<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Developpeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {    
        $builder
            ->add('NomEquipe', TextType::class,['label'=>'Nom de l\'équipe'])
            ->add('developpeurs',  EntityType::class, [
                'label' => 'Les développeurs de l\'équipe',
                'class' => Developpeur::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'email',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}
