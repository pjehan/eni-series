<?php

namespace App\Controller\Admin;

use App\Entity\Season;
use App\Entity\Serie;
use App\Form\SeasonType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SerieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Serie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('overview'),
            ChoiceField::new('status')->setChoices([
                'En cours' => 'En cours',
                'Terminée' => 'Terminée',
            ]),
            NumberField::new('vote'),
            NumberField::new('popularity'),
            ChoiceField::new('genres')->setChoices([
                'Action' => 'Action',
                'Animation' => 'Animation',
                'Aventure' => 'Aventure',
                'Comédie' => 'Comédie',
                'Crime' => 'Crime',
                'Documentaire' => 'Documentaire',
                'Drame' => 'Drame',
                'Famille' => 'Famille',
                'Fantastique' => 'Fantastique',
                'Guerre' => 'Guerre',
                'Histoire' => 'Histoire',
                'Horreur' => 'Horreur',
                'Musique' => 'Musique',
                'Mystère' => 'Mystère',
                'Romance' => 'Romance',
                'Science-Fiction' => 'Science-Fiction',
                'Téléfilm' => 'Téléfilm',
                'Thriller' => 'Thriller',
                'Western' => 'Western',
            ]),
            DateField::new('firstAirDate'),
            DateField::new('lastAirDate'),
            ImageField::new('backdrop', 'Backdrop')
                ->setBasePath('uploads/backdrops/')
                ->setUploadDir('public/uploads/backdrops/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ImageField::new('poster', 'Poster')
                ->setBasePath('uploads/posters/series/')
                ->setUploadDir('public/uploads/posters/series/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            NumberField::new('tmdbId'),
            CollectionField::new('seasons')->useEntryCrudForm(SeasonCrudController::class),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters->add('name');
    }


}
