<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class MainController
 * @package App\Controller
 */
class MainController extends AbstractController
{
    public function index()
    {
        return $this->render('index.html.twig');
    }
}
