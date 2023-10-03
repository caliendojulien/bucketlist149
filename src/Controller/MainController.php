<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/about-us', name: 'main_about_us')]
    public function aboutus(): Response
    {
        $fichier = file_get_contents('../data/team.json');
        $equipe = json_decode($fichier, true);
        return $this->render(
            'main/aboutus.html.twig',
            compact('equipe')
        );
    }
}
