<?php

namespace App\Controller\Admin;

use App\Entity\ItemType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ItemTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ItemType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
