<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Livre;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\LivreRepository;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\GroupBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LivreController extends AbstractController
{
    #[Route('/', name: 'app_byblio')]
    public function index(LivreRepository $repo): Response
    {
        return $this->render('livre/index.html.twig', [
            'livre' => $repo->findBy([], ['createdAt' => 'DESC'],1),
            'livrea' => $repo->findBy([], ['createdAt' => 'DESC'],1,1),
            'livreb' => $repo->findBy([], ['createdAt' => 'DESC'],1,2),
            'top' => $repo->findBy([], ['createdAt' => 'DESC'],1,3),
            'topa' => $repo->findBy([], ['createdAt' => 'DESC'],1,4),
            'topb' => $repo->findBy([], ['createdAt' => 'DESC'],1,5),
            'topc' => $repo->findBy([], ['createdAt' => 'DESC'],1,6),
            'topd' => $repo->findBy([], ['createdAt' => 'DESC'],1,7),
            'tope' => $repo->findBy([], ['createdAt' => 'DESC'],1,8),
            'topf' => $repo->findBy([], ['createdAt' => 'DESC'],1,9),
            'topg' => $repo->findBy([], ['createdAt' => 'DESC'],1,10),
            'toph' => $repo->findBy([], ['createdAt' => 'DESC'],1,11),
        ]);
    }
    //affichage de la page de livre
    #[isGranted('ROLE_USER')]
    #[Route(path:'livre/{id}', name:'showone', requirements:['/livre/id' => '\d+'])]
    public function showone(Livre $livre, LivreRepository $repo, $id, EntityManagerInterface $em, CommentRepository $commentRepo, Request $request, UrlGeneratorInterface $urlGenerator)
    {
        $livre = $repo->find($id);
        if(!$livre){
            return $this->redirectToRoute('app_byblio');
        }
        // Récupérer les commentaires associés au post
        $comments=$commentRepo->findBy(['livre'=>$livre],['createdAt'=>'ASC']);
        //instancier(créer) le comment
        $comment = new Comment();
        $commentForm=$this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);
        //faire les conditions
        if ($commentForm->isSubmitted() && $commentForm->isValid()){
                $comment->setLivre($livre);
                $comment->setUser($this->getUser());
                $comment->setContent($commentForm->get('content')->getData());

                //persister
                $em->persist($comment);
                //ecrire dans la bdd
                $em->flush();
                //reinicialiser le formulaire
                $comment = new Comment();
                $commentForm = $this->createForm(CommentType::class, $comment);
                //$commentForm->handleRequest($request); 
                //réderiction
                return new RedirectResponse($urlGenerator->generate('showone', ['id'=>$livre->getId()]));
                }
            //sécurité (empecher modification d'ID dans l'adresse de la page par la personne malveillante)
            //Affichage
            return $this->render('show/readOne.html.twig',[
                'livre'=>$livre,
                'commentForm'=>$commentForm->createView(),
                'comments'=>$comments,

            ]);
        }   
        

    //Recuperer les commentaires associés au livre
    
    

    

    //affichage de page de liste de livres
    #[Route('/livres', name: 'app_livres')]
    public function showlivres(LivreRepository $repo): Response
    {
        return $this->render('livres/livres.html.twig', [
            //'livres' => $repo->findAll(),
            'livres' => $repo->findBy([], ['genre' => 'DESC']),

        ]);
    }

    #[Route(path:'/jeunesse', name: 'app_jeunesse')]
    public function findLivresJeunesse(LivreRepository $repo): Response
    {
        $jeunesse = $repo->FindLivresJeunesse();

        return $this->render('jeunesse\jeunesse.html.twig', [
            'jeunesse' => $jeunesse,
            ]);
    }

    #[Route(path:'/contes', name: 'app_contes')]
    public function findLivresContes(LivreRepository $repo): Response
    {
        $contes = $repo->FindLivresContes();

        return $this->render('contes\contes.html.twig', [
            'contes_et_nouvelles' => $contes,
            ]);
    }
}

