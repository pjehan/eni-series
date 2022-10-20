<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Repository\SerieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/test')]
class TestController extends AbstractController
{
    #[Route('/', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/create')]
    public function create(ManagerRegistry $doctrine): Response
    {
        // $entityManager = $this->getDoctrine()->getManager();
        $entityManager = $doctrine->getManager();

        $you = new Serie();
        $you->setName('You');
        $you->setOverview('Le gestionnaire intelligent d\'une librairie compte sur ses connaissances informatique pour que la femme de ses rêves tombe amoureuse de lui.');
        $you->setStatus('ended');
        $you->setVote(7.7);
        $you->setPopularity(117);
        $you->setGenres('Policier / Drame / Romantique');
        $you->setFirstAirDate(new \DateTime('2018-09-09'));
        $you->setLastAirDate(new \DateTime('2022-10-20'));
        $you->setBackdrop('you.jpg');
        $you->setPoster('you.jpg');
        $you->setTmdbId(78191);
        $you->setDateCreated(new \DateTime());

        $entityManager->persist($you);
        $entityManager->flush();

        // $entityManager->getRepository(Serie::class)->save($you, true);

        return new Response('La série You a été créée');
    }

    #[Route('/update')]
    public function update(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        // Récupérer le repository de Serie
        $serieRepository = $entityManager->getRepository(Serie::class);

        // Récupérer la série You
        $you = $serieRepository->findOneBy(['name' => 'you']);
        // $serieRepository->findOneByName('you');

        $you->setOverview('Test série You');

        $entityManager->flush();

        return new Response('La série You a été modifiée');
    }

    #[Route('/delete')]
    public function delete(SerieRepository $serieRepository): Response
    {
        $you = $serieRepository->findOneByName('you');

        if (null == $you) {
            return new Response('La série You n\'existe pas !');
        }

        /*
        try {
            $serieRepository->remove($you, true);
        } catch (\TypeError) {
            return new Response('La série You n\'existe pas !');
        }
        */

//        $entityManager->remove($you);
//        $entityManager->flush();

        return new Response('La série You a été supprimée');
    }
}
