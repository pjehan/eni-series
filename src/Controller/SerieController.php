<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $series = $serieRepository->findAllWithSeasons();
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

        if ($serie === null) {
            throw $this->createNotFoundException('Page not found');
        }

        return $this->render('serie/detail.html.twig', [
            'serie' => $serie
        ]);
    }

    #[Route('/new', name: 'series_new')]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $serie = new Serie();
        $serie->setDateCreated(new \DateTime()); // Ou utiliser les LifeCycleCallbacks de Doctrine
        $serieForm = $this->createForm(SerieType::class, $serie);

        // Récupération des données pour les insérer dans l'objet $serie
        $serieForm->handleRequest($request);

        // Vérifier si l'utilisateur est en train d'envoyer le formulaire
        if ($serieForm->isSubmitted() && $serieForm->isValid()) {
            // $this->denyAccessUnlessGranted('ROLE_ADMIN');

            // Enregistrer la nouvelle série en BDD
            $em->persist($serie);
            $em->flush();

            $this->addFlash('success', 'La série a bien été créée !');

            // Rediriger l'internaute vers la liste des séries
            return $this->redirectToRoute('series_list');
        }

        return $this->render('serie/new.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }
}
