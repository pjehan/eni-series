<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/series')]
class SerieController extends AbstractController
{
    #[Route('/', name: 'series_list')]
    public function list(SerieRepository $serieRepository): Response
    {
        // Récupérer les séries en base de données
        // $series = $serieRepository->findAllBetweenDates(new \DateTime('2019-01-01'), new \DateTime('2019-12-31'));
        $series = $serieRepository->findBy([], ['firstAirDate' => 'DESC', 'name' => 'ASC']);
        // SQL généré : SELECT * FROM serie ORDER BY first_air_date DESC, name ASC;

        return $this->render('serie/index.html.twig', [
            'series' => $series
        ]);
    }

    #[Route('/{id}', name: 'series_detail', requirements: ['id' => '\d+'])]
    public function detail(SerieRepository $serieRepository, int $id): Response
    {
        // Récupérer la série à afficher en base de données
        $serie = $serieRepository->find($id);

        return $this->render('serie/detail.html.twig', [
            'serie' => $serie
        ]);
    }

    #[Route('/new', name: 'series_new')]
    public function new(): Response
    {
        return $this->render('serie/new.html.twig');
    }
}
