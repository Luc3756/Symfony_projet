<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_redirect')]
    public function redirectToHome(): RedirectResponse
    {
        return new RedirectResponse($this->generateUrl('home'));
    }
    
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
