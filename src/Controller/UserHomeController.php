<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserHomeController extends AbstractController
{
    #[Route('/user/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('user_home/index.html.twig');
    }
}
