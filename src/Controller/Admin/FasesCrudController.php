<?php

namespace App\Controller\Admin;

use App\Entity\Fases;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class FasesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fases::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('nombre'),
            TextEditorField::new('descripcion'),
        ];
    }
    
}