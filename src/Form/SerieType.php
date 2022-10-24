<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'input-serie-name']
            ])
            ->add('overview', TextareaType::class, [
                'label' => 'Résumé'
            ])
            ->add('status')
            ->add('vote', NumberType::class, [
                'html5' => true
            ])
            ->add('popularity', NumberType::class, [
                'html5' => true
            ])
            ->add('genres')
            ->add('firstAirDate', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('lastAirDate', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('backdrop', FileType::class)
            ->add('poster', FileType::class)
            ->add('tmdbId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
