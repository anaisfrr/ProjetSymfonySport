<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExemplesController extends AbstractController
{
    #[Route('/exemples/sport/exemples/insert')]
    public function index(): Response
    {
        return $this->render('exemples/index.html.twig', [
            'controller_name' => 'ExemplesController',
        ]);
    }
}
