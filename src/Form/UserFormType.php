<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserFormType extends AbstractType
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
            ->add('postcode')
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
            ->add('email', EmailType::class) 
            
              
                     
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
