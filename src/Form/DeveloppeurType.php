<?php

namespace App\Form;

use App\Entity\Developpeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeveloppeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('password')
            ->add('Nom')
            ->add('Prenom')
            ->add('RIB')
            ->add('NombreHeures')
            ->add('Adresse')
            ->add('Sexe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Developpeur::class,
        ]);
    }
}
