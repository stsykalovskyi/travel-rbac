<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Trip;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BackPacker');
    }


    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-dashboard'),
            MenuItem::section('Розділи сайту', 'fa fa-list'),
            MenuItem::linkToRoute('Головна', 'fa fa-home', 'main'),
            MenuItem::section('Блог', 'fa fa-blog'),
            MenuItem::linkToCrud('Статьи', 'fa fa-file-o', Article::class),
            MenuItem::section('Подорожі'),
            MenuItem::linkToCrud('Екскурсії', 'fa fa-road', Trip::class),
            MenuItem::section('Коментарі', 'fa fa-comments-o'),
            MenuItem::section('Адміністрування', 'fa fa-list'),
            MenuItem::linkToCrud('Користувачі', 'fa fa-user', User::class)
        ];
    }
}
