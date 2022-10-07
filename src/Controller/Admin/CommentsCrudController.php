<?php

namespace App\Controller\Admin;

use App\Entity\Comments;

use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comments::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('user.username', 'Auteur'),
            NumberField::new('article.id', 'Id Article'),
            TextEditorField::new('comment', 'Commentaire'),
            Field::new('date', 'Date de création'),
           
        ];
    }
    
}
