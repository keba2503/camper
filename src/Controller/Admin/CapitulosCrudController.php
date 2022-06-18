<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

use App\Entity\Capitulos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CapitulosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Capitulos::class;
    }


    
    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Fases'),
            AssociationField::new('fases')
                ->setRequired(true)
                ->setHelp('Escoger fase a la que pertenece el capitulo'),
            FormField::addPanel('Capitulos'),
            TextField::new('nombre'),
            TextEditorField::new('descripcion'),
            TextField::new('link'),
            TextField::new('image'),
        ];
    }
    
}
