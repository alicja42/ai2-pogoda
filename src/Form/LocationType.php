<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', null, [
                'attr' => [
                    'placeholder' => 'Enter city name',
                    'class' => 'form-control',
                ],
            ])
            ->add('country', ChoiceType::class, [
                'label' => 'country',
                'choices' => [
                    'Poland' => 'PL',
                    'Germany' => 'DE',
                    'Spain' => 'ES',
                    'Italy' => 'IT',
                    'France' => 'FR',
                    'United Kingdom' => 'GB',
                    'Monaco' => 'MC',
                ],
                'placeholder' => 'Choose a country',
                'attr' => ['class' => 'form-select'],
            ])

            ->add('latitude', NumberType::class, [
                'label' => 'latitude',
                'scale' => 6,
                'attr' => [
                    'step' => 0.000001,
                    'placeholder' => 'Enter latitude',
                    'class' => 'form-control',
                ],
            ])

            ->add('longitude', NumberType::class, [
                'label' => 'longitude',
                'scale' => 6,
                'attr' => [
                    'step' => 0.000001,
                    'placeholder' => 'Enter longitude',
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
            'validation_groups' => ['Default'],
        ]);
    }
}
