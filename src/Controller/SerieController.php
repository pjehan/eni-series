<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/series')]
class SerieController extends AbstractController
{
    #[Route('/', name: 'series_list')]
    public function list(): Response
    {
        $series = [
            [
                'id' => 1,
                'title' => 'Game of thrones'
            ],
            [
                'id' => 2,
                'title' => 'The office'
            ]
        ];

        return $this->render('serie/index.html.twig', [
            'series' => $series
        ]);
    }

    #[Route('/{id}', name: 'series_detail', requirements: ['id' => '\d+'])]
    public function detail(): Response
    {
        return $this->render('serie/detail.html.twig');
    }

    #[Route('/new', name: 'series_new')]
    public function new(): Response
    {
        return $this->render('serie/new.html.twig');
    }
}
