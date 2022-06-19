<?php

namespace App\Controller\Admin;

use App\Entity\Lista;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class ListaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lista::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Lista')
            ->setEntityLabelInPlural('Listas')
            ->setSearchFields(['nombre', 'image', 'estado']);
            
    }



    public function configureFields(string $pageName): iterable
    {

        yield  FormField::addPanel('TipoLista');
        yield    AssociationField::new('tipoLista')
            ->setRequired(true)
            ->setHelp('Tipo Lista');
        yield    FormField::addPanel('Capitulos');
        yield     AssociationField::new('capitulos')
            ->setRequired(true)
            ->setHelp('Capitulos');
        yield     FormField::addPanel('Lista');
        yield     TextField::new('nombre');
        yield    TextField::new('image');
        yield    BooleanField::new('estado')->setColumns(2);



    

    }
    
}
