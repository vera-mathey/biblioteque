<?php

namespace App\Controller;
use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(AuthorRepository $repoauthor): Response
    {
        return $this->render('author/index.html.twig', [
            'author' => $repoauthor->findAll(),

        ]);
    }

    //affichage de la page d'author
    #[Route(path:'/author/{id}', name:'showauthor', condition:'params["id"]')]
    public function showauthor(Author $author, AuthorRepository $repoauthor, Author $author_id, EntityManagerInterface $em)
    {
        $author = $repoauthor->find($author_id);
        //sécurité (empecher modification d'ID dans l'adresse de la page par la personne malveillante)
        if(!$author){
        return $this->redirectToRoute('app_author');
    }
    return $this->render('show/readOneAuthor.html.twig', [
        'author'=> $author,
    ]);
    }

}
