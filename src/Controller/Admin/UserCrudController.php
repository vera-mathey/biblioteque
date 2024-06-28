<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    public function configureCrud(Crud $crud): Crud
    {   return $crud
            ->setEntityLabelInPlural('Utisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setPageTitle("index", "Bibliothèque - Administration")
            ->setEntityLabelInSingular('User')
            ->setPaginatorPageSize(5);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('firstname')->setColumns('col-md-4'),
            TextField::new('lastname')->setColumns('col-md-4'),
            TextField::new('lastname')->setColumns('col-md-4'),
            DateField::new('createdAt')->hideOnForm()->setColumns('col-md-3'),
            $avatar = ImageField::new('avatar')
                ->setUploadDir('public\divers\images\users')
                ->setBasePath('divers\images\users')
                ->setSortable(False)
                ->setCssClass('image_ronde')
                ->setFormTypeOption('required', False)->setColumns('col-md-2'),

            /*$image = ImageField::new('avatar')
                ->setUploadDir('public/divers/images/users')
                ->setBasePath('divers/images/users')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('Col-md-4'),*/
            //ImageField::new('avatar')->setUploadDir('public/divers/images/users')->setColumns('col-md-4'),
            BooleanField::new('roleadmin')->setColumns('col-md-4'),

            TextField::new('password'),
            $roles = ChoiceField::new('roles')->setColumns('col-md-4')->setChoices([
                'ROLE_USER' => 'ROLE_USER',
                'ROLE_EDITOR' => 'ROLE_EDITOR',
                'ROLE_MODO' => 'ROLE_MODO',
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
            ])->allowMultipleChoices(),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('Firstname')
        ->add('Lastname');
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
    }
}
