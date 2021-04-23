<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class UserCrudController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_HUMAN_RESOURCES")
 */
class UserCrudController extends AbstractCrudController
{
    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            CollectionField::new('roles')
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        /** @var User $user */
        $user = $entityInstance;
        $user->setPassword($this->encoderFactory->getEncoder(User::class)
            ->encodePassword('d~*BYkkkSdL8Y&N-', base64_encode(random_bytes(30))));
        parent::persistEntity($entityManager, $entityInstance);
    }
}
