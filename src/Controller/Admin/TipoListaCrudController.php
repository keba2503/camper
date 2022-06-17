<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use App\Entity\TipoLista;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TipoListaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TipoLista::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Capitulos'),
            AssociationField::new('capitulos')
                ->setRequired(true)
                ->setHelp('capitulo '),
            FormField::addPanel('Tipo Lista'),
            TextField::new('nombre'),
            TextEditorField::new('descripcion'),
        ];
    }
    
}
