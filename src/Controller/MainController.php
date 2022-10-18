<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $city = 'ouagadougou';
        $vegetables = ['carotte', 'tomate', 'patate'];

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'city' => $city,
            'vegetables' => $vegetables,
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        $tel = '0123456789';
        $email = 'contact@series.com';

        return $this->render('main/contact.html.twig', compact('tel', 'email'));
        /*
        return $this->render('main/contact.html.twig', [
            'phone' => $tel,
            'email' => $email,
        ]);
        */
    }
}
