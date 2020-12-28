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

class CommentCrudController extends AbstractCrudController
{
     public const COMMENT_STATUS = [
        'submitted' => 'submitted',
        'spam' => 'spam',
        'published' => 'published'
    ];

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
            ChoiceField::new('state')->setChoices(self::COMMENT_STATUS)
        ];
    }

}
