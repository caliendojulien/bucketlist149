<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', name: 'wish')]
class WishController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function list(
        WishRepository $wishRepository
    ): Response
    {
        $wishes = $wishRepository->findBy(
            [], // WHERE
            ["dateCreated" => 'DESC'] // ORDER BY
        );
        return $this->render(
            'wish/list.html.twig',
            compact('wishes')
        );
    }

    #[Route('/filtre/{debut}/{fin}', name: '_filtre_par_date')]
    public function filtre_par_date(
        $debut,
        $fin,
        WishRepository $wishRepository
    ) : Response
    {
        $wishes = $wishRepository->findBetweenDate($debut, $fin);
        return $this->render(
            'wish/list.html.twig',
            compact('wishes')
        );
    }

    #[Route('/details/{wish}', name: '_details')]
    public function details(
        Wish $wish
    ): Response
    {
        return $this->render(
            'wish/details.html.twig',
            compact('wish')
        );
    }
}
