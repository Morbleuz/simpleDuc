<?php

namespace App\Form;
use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SecurityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,['label'=> false, 'attr' => ['class'=> 'w3-input w3-border', 'placeholder' => 'Email']])
            ->add('password', PasswordType::class,['label'=> false, 'attr' => ['class'=> 'w3-section w3-input w3-border', 'placeholder' => 'Mot de passe']])
            ->add('envoyer', SubmitType::class,['label'=> 'Envoyer', 'attr' => ['class'=> 'w3-button w3-black w3-section']] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
