<?php

namespace App\Form;

use App\Entity\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
class EmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('objet', TextType::class,['label'=> "Objet", 'attr' => ['class'=> 'form-control', 'placeholder' => '']
        ,'constraints' => [new NotBlank(["message" => "Ne peut pas être vide"])]
        ])
        ->add('message', TextareaType::class,['label'=> "Message", 'attr' => ['class'=> 'form-control', 'placeholder' => '']
        ,'constraints' => [new NotBlank(), new Length(['min' => '10'])]
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Email::class,
        ]);
    }
}
