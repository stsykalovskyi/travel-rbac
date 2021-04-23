<?php

namespace App\Controller\Admin;

use App\Entity\Trip;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class TripCrudController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_GUIDE")
 */
class TripCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trip::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('resource')->setBasePath('/uploads/images')->setUploadDir('public/uploads/images'),
            TextField::new('subject'),
            CountryField::new('country'),
            TextEditorField::new('description'),
            AssociationField::new('author')->setPermission('ROLE_MODERATOR'),
            MoneyField::new('price')->setCurrency('UAH')
        ];
    }

    public function createIndexQueryBuilder(
        SearchDto $searchDto,
        EntityDto $entityDto,
        FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder {
        $res = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);
        if (!$this->isGranted('ROLE_MODERATOR')) {
            $res->andWhere('entity.author = :author')->setParameter('author', $this->getUser());
        }
        return $res;
    }

    public function createEntity(string $entityFqcn)
    {
        $trip = new Trip();
        $trip->setAuthor($this->getUser());
        return $trip;
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
