<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Livres')
        ->setEntityLabelInSingular("Livre")
        ->setPageTitle("index", "Bibliothèque - Administration")
        ->setEntityLabelInSingular('Livre')
        ->setPaginatorPageSize(10);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->OnlyOnIndex()->setColumns('col-md-4'),
            TextField::new('title')->setColumns('col-md-4'),
            $image = ImageField::new('image')
                ->setUploadDir('public/divers/images/livres')
                ->setBasePath('divers/images/livres')
                ->setSortable(false)
                ->setFormTypeOption('required', false)->setColumns('Col-md-4'),


            //ImageField::new('image')->setUploadDir('public/divers/images/livres')->setColumns('col-md-4'),
            TextareaField::new('abstract')->setColumns('col-md-12'),
            TextareaField::new('content')->setColumns('col-md-12'),
            DateField::new('createdAt')->hideOnForm()->setColumns('col-md-3'),
            AssociationField::new('author')->setColumns('col-md-3'),
            AssociationField::new('user')->setColumns('col-md-3'),
            AssociationField::new('genre')->setColumns('col-md-3'),
            TextField::new('slug')->OnlyOnIndex()->setColumns('col-md-4'),
        ];
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        
        ->Add('author');
    }

}
