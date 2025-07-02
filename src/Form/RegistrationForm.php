<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('age', IntegerType::class)
            ->add('email', EmailType::class)
            ->add('plainPassword', RepeatedType::class,
            [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password', 
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Password is required.']),
                    new Assert\Length([ 'min' => 8, 'minMessage' => 'Password must be at least 8 characters long.']),
                    new Assert\Regex(['pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).+$/', 'message' => 'The password must contain at least one uppercase, one lowercase, one digit and one special character.'])
                ],
            ],    
                'second_options' => ['label' => 'Repeat Password'],
                'invalid_message' => 'The password fields must match.',
                'mapped' => false, 

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
