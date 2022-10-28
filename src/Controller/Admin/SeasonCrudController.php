<?php

namespace App\Controller\Admin;

use App\Entity\Season;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class SeasonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Season::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('number'),
            DateField::new('firstAirDate'),
            TextEditorField::new('overview'),
            ImageField::new('poster', 'Poster')
                ->setBasePath('uploads/posters/seasons/')
                ->setUploadDir('public/uploads/posters/seasons/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            NumberField::new('tmdbId'),
        ];
    }
}
