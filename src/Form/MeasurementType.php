<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'form-control'],
                    'placeholder' => 'Choose date'
            ])
            ->add('celsius', NumberType::class, [
                'label' => 'Temperature (Celsius)',
                'scale' => 1,
                'attr' => [
                    'class' => 'form-control',
                    'step' => 0.1,
                ]
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => function(Location $location) {
                return $location->getCity() . ', ' . $location->getCountry();
                },
                'placeholder' => 'Choose location',
                'attr' => ['class' => 'form-select'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
            'validation_groups' => ['Default'],
        ]);
    }
}
