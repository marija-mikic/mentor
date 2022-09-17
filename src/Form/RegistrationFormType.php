<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\State;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\IsTrue;
use ZipArchive;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [ 
                'required'=> false,                                  
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your name',                        
                    ]),
                    new Length ([
                        'min'=> 3,
                        'minMessage'=> 'Your name should be at least {{ limit }} characters'
                         
                    ])
                ]
            ])
            ->add('surname', TextType::class, [                 
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your name'
                    ]),
                    new Length ([
                        'min'=> 3,
                        'minMessage'=> 'Your name should be at least {{ limit }} characters'
                         
                    ])
                ]
            ])
            ->add('username')
            ->add('adress')
            ->add('house_number',NumberType::class,[
                'mapped' => false
            ])
            ->add('postcode',NumberType::class,[
                'mapped' => false
            ])
            ->add('city',TextType::class, [                 
                'constraints' => [
                    new NotBlank([
                        'message' => 'name of city'
                    ]),
                    new Length ([
                        'min'=> 2,
                        'minMessage'=> 'Your name should be at least {{ limit }} characters'
                         
                    ])
                ]
            ])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'placeholder'=> 'Choose country'
            ])
            ->add('email', EmailType::class)
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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