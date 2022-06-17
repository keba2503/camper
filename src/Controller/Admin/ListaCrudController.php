<?php

namespace App\Controller\Admin;

use App\Entity\Lista;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('TipoLista'),
            AssociationField::new('tipoLista')
                ->setRequired(true)
                ->setHelp('Tipo Lista'),
            FormField::addPanel('Capitulos'),
            AssociationField::new('capitulos')
                ->setRequired(true)
                ->setHelp('Capitulos'),
            FormField::addPanel('Lista'),
            TextField::new('nombre'),
            TextField::new('image'),
            BooleanField::new('estado')->setColumns(2)
            
           
        ];
    }
}
