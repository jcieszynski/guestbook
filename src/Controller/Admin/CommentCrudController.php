<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use http\Env;
use Symfony\Component\Form\Extension\Core\Type\RadioType;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('author'),
            EmailField::new('email'),
            DateTimeField::new('createdAt'),
            TextEditorField::new('text'),
            ImageField::new('photoFilename')->setUploadDir('/public/uploads/photos'),
            AssociationField::new('conference')->autocomplete(),
            ChoiceField::new('state')->setChoices(['submitted' => 'submitted'])
        ];
    }

}
