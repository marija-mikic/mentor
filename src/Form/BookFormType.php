<?php

namespace App\Form;


use App\Entity\Book;
use App\Entity\FM;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('author', TextType::class)
            ->add('about', TextType::class)
            ->add('nrpage', IntegerType::class)
            ->add('FM', EntityType::class, [
                'class' => FM::class,
                'placeholder' => 'Choose type of book',
                'choice_label' => function (FM $fM) {
                    return $fM->getMaterijal();
                }
            ])
            ->add('FM', EntityType::class, [
                'class' => FM::class,
                'placeholder' => 'Choose type of book',
                'choice_label' => function (FM $fM) {
                    return $fM;
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
