<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('description'),
            ImageField::new('image')->setBasePath('/uploads/images')->setUploadDir('public/uploads/images'),
            BooleanField::new('enabled'),
            CollectionField::new('tags')
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $article = new Article();
        $article->setAuthor($this->getUser());
        return $article;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        /** @var Article $entity */
        $entity = $entityInstance;
        $entity->setShortDescription('test desc');
        parent::persistEntity($entityManager, $entityInstance);
    }
}
