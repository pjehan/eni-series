<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('overview')
            ->add('status')
            ->add('vote')
            ->add('popularity')
            ->add('genres')
            ->add('firstAirDate')
            ->add('lastAirDate')
            ->add('backdrop')
            ->add('poster')
            ->add('tmdbId')
            ->add('dateCreated')
            ->add('dateModified')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
