<?php

namespace App\Controller;
use App\Entity\Genre;
use App\Entity\Livre;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    #[Route('/genre', name: 'app_genre')]
    public function index(GenreRepository $repogenre): Response
    {
        return $this->render('genre/index.html.twig', [
            'genre' => $repogenre->findAll(),

        ]);
    }
    #[Route(path:'/genre/{id}', name:'showgenre', condition:'params["id"]')]
    public function showauthor(Genre $genre, GenreRepository $repogenre, Genre $genre_id, EntityManagerInterface $em)
    {
        $genre = $repogenre->find($genre_id);
        //sécurité (empecher modification d'ID dans l'adresse de la page par la personne malveillante)
        if(!$genre){
        return $this->redirectToRoute('app_author');
    }
    return $this->render('show/readOneGenre.html.twig', [
        'genre'=> $genre,
    ]);
    }
}