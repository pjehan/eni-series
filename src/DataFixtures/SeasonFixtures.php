<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $finder = new Finder();
        $finder->in('src/DataFixtures/sql');
        $finder->name('season.sql');

        foreach ($finder->files() as $file) {
            $this->entityManager->getConnection()->executeQuery($file->getContents());
        }
    }

    public function getDependencies()
    {
        return [SerieFixtures::class];
    }
}
