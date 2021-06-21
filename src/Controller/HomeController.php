<?php

namespace App\Controller;

use App\Model\YoutubeApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $youtubeApi = new YoutubeApiClient($this->getParameter('app.youtube_api_key'));
        $test = $youtubeApi;

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'cocktail_url' => $test
        ]);
    }
    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
