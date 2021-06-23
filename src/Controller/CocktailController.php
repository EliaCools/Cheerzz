<?php

namespace App\Controller;

use App\Entity\Cocktail;
use App\Entity\User;
use App\Form\CocktailType;
use App\Model\CocktailApiClient;
use App\Repository\CocktailRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cocktail')]
class CocktailController extends AbstractController
{
    private const ALPHABET = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0',];

    #[Route('/{firstCharacter}', name: 'cocktail_index', methods: ['GET'])]
    public function index(CocktailApiClient $cocktailClient, string $firstCharacter): Response
    {
        $shoppingCart = null;

        /** @var User $user */
        $user = $this->getUser();

        if($user !== null){
            $shoppingCart = $user->getSingleShoppingCart();
        }


        return $this->render('cocktail/index.html.twig', [
            'cocktails' => $cocktailClient->fetchCocktailsByFirstLetter($firstCharacter),
            'alphabet' => self::ALPHABET,
            'shoppingCart' => $shoppingCart
        ]);
    }


    #[Route('/{id}/show', name: 'cocktail_show', methods: ['GET'])]
    public function show(int $id, CocktailApiClient $client, ProductRepository $productRepository): Response
    {
        $cocktail = $client->fetchCocktailById($id);
        $products = [];
        if (isset($cocktail))
        {
            foreach ($cocktail->getIngredientsAndMeasurements() as $ingredient)
            {
                $name = $ingredient[0];
                $measurement = $ingredient[1];
                $products[] = [
                    'name' => $name,
                    'measurement' => $measurement,
                    'id' => $productRepository->findByProductName($name)->getId(),
                ];
            }
        }

        $shoppingCart = null;

        /** @var User $user */
        $user = $this->getUser();

        if($user !== null){
            $shoppingCart = $user->getSingleShoppingCart();
        }


        return $this->render('cocktail/show.html.twig', [
            'cocktail' => $cocktail,
            'products' => $products,
            'shoppingCart' => $shoppingCart
        ]);
    }

}
