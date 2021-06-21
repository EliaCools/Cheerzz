<?php

namespace App\Controller;

use App\Model\CocktailApiClient;
use App\Model\JsonToObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CocktailAccessController extends AbstractController
{
    #[Route('/cocktail/access', name: 'cocktail_access')]
    public function index(CocktailApiClient $client, ): Response
    {
        $jsonToObject = new JsonToObject($client);
        $response = $jsonToObject->converToObject();
            dd($response);
        //$response = $client->fetchCocktailsByFirstLetter('a');

    }
}
