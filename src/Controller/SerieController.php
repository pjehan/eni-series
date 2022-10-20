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
        $series = $serieRepository->findAll();

        return $this->render('serie/index.html.twig', [
            'series' => $series
        ]);
    }

    #[Route('/{id}', name: 'series_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        // TODO: Récupérer la série à afficher en base de données

        return $this->render('serie/detail.html.twig', [
            'id' => $id
        ]);
    }

    #[Route('/new', name: 'series_new')]
    public function new(): Response
    {
        return $this->render('serie/new.html.twig');
    }
}
