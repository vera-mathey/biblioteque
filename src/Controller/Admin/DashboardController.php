<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Livre;
use App\Entity\Author;
use App\Entity\Genre;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{
//Declarer la variable $userRepository en protected
    protected $userRepository;
    //Mettre en place le constructor
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();
        //fixer le role le moins élevé
        if($this->isGranted('ROLE_EDITOR')) {
            return $this->render('Admin/dashboard.html.twig');
        }else
            return $this->redirectToRoute('app_byblio');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Byblio');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Go To Site', 'fa-solid fa-arrow-rotate-left', 'app_byblio');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::linkToDashboard('Dashboard', 'fa fa-Livre')
            ->setPermission('ROLE_ADMIN');
        }
        if($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Livres');
            yield MenuItem::subMenu('Livres', 'fa-sharp fa-solid fa-blog')
            ->setSubItems([
                MenuItem::LinkToCrud('Create Livre', 'fas fa-newspaper', Livre::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show livre', 'fas fa-eye', Livre::class)
            ]);
        }
        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('User');
            yield MenuItem::subMenu('User','fa-sharp fa-solid fa-blog')
            ->setSubItems([
                MenuItem::linkToCrud('Create User','fas fa-newspaper', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show User','fas fa-eye', User::class),
            ]);
        }
        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Genre');
            yield MenuItem::subMenu('Genre','fa-sharp fa-solid fa-blog')
            ->setSubItems([
                MenuItem::linkToCrud('Create Genre','fas fa-newspaper', Genre::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Genre','fas fa-eye', Genre::class),
            ]);
        }
        if($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Author');
            yield MenuItem::subMenu('Author','fa-sharp fa-solid fa-blog')
            ->setSubItems([
                MenuItem::linkToCrud('Create Author','fas fa-newspaper', Author::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Author','fas fa-eye', Author::class),
            ]);
        }
        if($this->isGranted('ROLE_SUPER_ADMIN')){
            yield MenuItem::section('Users');
            yield MenuItem::subMenu('Users','fa-sharp fa-solid fa-blog')
            ->setSubItems([
                MenuItem::linkToCrud('Create User','fas fa-newspaper', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show User','fas fa-eye', User::class),
            ]);
        }
    }
}
