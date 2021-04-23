<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Trip;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_USER")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BackPacker');
    }


    public function configureMenuItems(): iterable
    {
        $items = [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-dashboard'),
            MenuItem::subMenu('Розділи сайту', 'fa fa-list')->setSubItems([
                MenuItem::linkToRoute('Головна', 'fa fa-home', 'main')
            ]),
            MenuItem::subMenu('Блог', 'fa fa-blog')->setPermission('ROLE_EDITOR')->setSubItems([
                MenuItem::linkToCrud('Статьи', 'fa fa-file-o', Article::class)->setPermission('ROLE_EDITOR')
            ]),
            MenuItem::section('Подорожі')->setPermission('ROLE_GUIDE'),
            MenuItem::linkToCrud('Екскурсії', 'fa fa-road', Trip::class)->setPermission('ROLE_GUIDE'),
            MenuItem::section('Коментарі', 'fa fa-comments-o')->setPermission('ROLE_MODERATOR'),
            MenuItem::subMenu('Адміністрування', 'fa fa-list')
                ->setPermission('ROLE_ADMIN')
                ->setPermission('ROLE_HUMAN_RESOURCES')->setSubItems([
                    MenuItem::linkToCrud('Користувачі', 'fa fa-user', User::class)
                        ->setPermission('ROLE_HUMAN_RESOURCES')
                ]),
        ];
        if (!$this->isGranted('ROLE_GUIDE')) {
            $items[] = MenuItem::linkToRoute('Хочу быть гидом', 'fa fa-user', 'imguide');
        }
        return $items;
    }
}
