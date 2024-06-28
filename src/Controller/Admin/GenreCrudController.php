<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class GenreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Genre::class;
    }
public function configureCrud(Crud $crud): Crud
{
    return $crud
    ->setEntityLabelInPlural('Genres')
    ->setEntityLabelInSingular('Genre')
    ->setPageTitle("index", "Bibliothèque - Administration")
    ->setEntityLabelInSingular('Genre')
    ->setPaginatorPageSize(10);
}
   
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->OnlyOnIndex(),
            TextField::new('name')->setColumns('col-md-6'),
            //AssociationField::new('user')->hideOnForm()->setColumns('col-md-6'),
        ];
    }
   
}
