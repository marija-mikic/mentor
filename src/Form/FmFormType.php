<?php

namespace App\Form;

use App\Entity\FM;
use App\Entity\Format;
use App\Entity\Materijal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FmFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', MoneyType::class)
            ->add('format', EntityType::class, [
                'class' => Format::class,
                'choice_label' => function (Format $format) {
                    return $format->getName();
                },
                'required' => false,
                'placeholder' => 'Choose format',
            ])
            ->add(
                'materijal',
                EntityType::class,
                [
                    'class' => Materijal::class,
                    'choice_label' => function (Materijal $materijal) {
                        return $materijal->getName();
                    },
                    'required' => false,
                    'placeholder' => 'Choose materijal',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FM::class,
        ]);
    }
}
