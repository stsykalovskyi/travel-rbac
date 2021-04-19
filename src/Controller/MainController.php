<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return $this->render('pages/main.html.twig');
    }

    /**
     * @Route("/actions", name="actions")
     */
    public function actions(): Response
    {
        return $this->render('pages/actions.html.twig');
    }

    /**
     * @Route("/posts", name="posts")
     */
    public function posts(): Response
    {
        return $this->render('pages/posts.html.twig');
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function contacts(): Response
    {
        return $this->render('pages/contacts.html.twig');
    }

    /**
     * @Route("/popular", name="popular")
     */
    public function popular(): Response
    {
        return $this->render('pages/popular_tours.html.twig');
    }
}
