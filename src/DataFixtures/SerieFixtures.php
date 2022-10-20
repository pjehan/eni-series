<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;

class SerieFixtures extends Fixture
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /*
     * Property Promotion en PHP 8.0
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}
    */

    public function load(ObjectManager $manager): void
    {
        $finder = new Finder();
        $finder->in('src/DataFixtures/sql');
        $finder->name('serie.sql');

        foreach ($finder->files() as $file) {
            $this->entityManager->getConnection()->executeQuery($file->getContents());
        }
    }
}
