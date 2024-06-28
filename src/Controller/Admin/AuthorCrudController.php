<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class AuthorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Author::class;
    }
public function configureCrud(Crud $crud): Crud
{
    return $crud
    ->setEntityLabelInPlural('Authors')
    ->setEntityLabelInSingular('Author')
    ->setPageTitle("index", "Bibliothèque - Administration")
    ->setEntityLabelInSingular("Author")
    ->setPaginatorPageSize(10);
}

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex()->setColumns('col-md-4'),
            TextField::new('firstname')->setColumns('col-md-4'),
            TextField::new('lastname')->setColumns('col-md-4'),
            ImageField::new('image')->setUploadDir('public/divers/images')->setColumns('col-md-4'),
            TextareaField::new('biographie')->setColumns('col-md-12'),
            AssociationField::new('user')->setColumns('col-md-4'),
        ];
    }

}
