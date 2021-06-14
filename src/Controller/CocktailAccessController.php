<?php

namespace App\Controller;

use App\Model\CocktailApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CocktailAccessController extends AbstractController
{
    #[Route('/cocktail/access', name: 'cocktail_access')]
    public function index(CocktailApiClient $client): Response
    {
        $response = $client->fetchCocktailsByFirstLetter('a');
        return $this->render('cocktail_access/index.html.twig', [
            'controller_name' => 'CocktailAccessController',
            'api_response' => $response,
        ]);
    }
}
