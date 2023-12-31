<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\UserRepository;
use App\Repository\WishRepository;
use App\Services\Censurator;
use App\Services\envoieEmail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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

    #[Route('/new', name: '_new')]
    #[IsGranted("ROLE_USER")]
    public function new(
        Request                $request,
        EntityManagerInterface $entityManager,
        Censurator $censurator
    ): Response
    {
        $wish = new Wish(); // On créé une instance de souhait
        $wish->setAuteur($this->getUser()->getUserIdentifier());
        $wishForm = $this->createForm(WishType::class, $wish); // On créé un formulaire associé a l'instance
        $wishForm->handleRequest($request); // On regarde ce qui est présent dans la requete
        if ($wishForm->isSubmitted() && $wishForm->isValid()) { // Si le formulaire a ete soumis
            $wish->setDateCreated(new \DateTime()); // On initialise la date de création a maintenant
            // Censurator
            $wish->setDescription($censurator->purify($wish->getDescription()));
            // Censurator
            $entityManager->persist($wish); // On prépare la requete SQL
            $entityManager->flush(); // On execute la requete SQL
            $this->addFlash('success', 'Le souhait a bien été ajouté'); // Ajout du msg flash
            return $this->redirectToRoute('wish_list'); // On redirige vers la liste des souhaits
        }
        return $this->render(
            'wish/new.html.twig',
            compact('wishForm')
        );
    }

    #[Route('/delete/{wish}', name: '_delete')]
    #[IsGranted("ROLE_USER")]
    public function delete(
        Wish                   $wish,
        EntityManagerInterface $entityManager,
        envoieEmail            $envoieEmail
    ): Response
    {
        $envoieEmail->envoi("delete");
        $entityManager->remove($wish);
        $entityManager->flush();
        $this->addFlash('success', 'Le souhait a bien été supprimé');
        return $this->redirectToRoute('wish_list');
    }

    #[Route('/filtre/{debut}/{fin}', name: '_filtre_par_date')]
    public function filtre_par_date(
        $debut,
        $fin,
        WishRepository $wishRepository
    ): Response
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
