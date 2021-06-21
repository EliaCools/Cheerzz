<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Cocktail;
use App\Entity\Ingredient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CocktailApiClient
{
    private HttpClientInterface $client;
    private JsonToObject $converter;

    private const SOURCE = 'https://www.thecocktaildb.com/api/json/v1/1/';

    //TODO: add instruction string suffixes for other languages at some point.

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->converter = new JsonToObject();
    }

    //<editor-fold desc="Cocktail Functions">

    /**
     * @param string $character
     * @return cocktail[]
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchCocktailsByFirstLetter(string $character): array
    {
        $response = $this->fetchRequest("search.php?f=$character");

        return $this->converter->convertToCocktails($response->getContent());
    }

    /**
     * @param string $name
     * @return Cocktail|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchCocktailByName(string $name): ?Cocktail
    {
        $response = $this->fetchRequest("search.php?s=$name");
        return $this->converter->convertToCocktail($response->getContent());
    }

    /**
     * @param int $id
     * @return Cocktail|null
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchCocktailById(int $id): ?Cocktail
    {
        $response = $this->fetchRequest("lookup.php?iid=$id");
        return $this->converter->convertToCocktail($response->getContent());
    }

    /**
     * @return Cocktail
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchRandomCocktail(): Cocktail
    {
        $response = $this->fetchRequest("random.php");
        return $this->converter->convertToCocktail($response->getContent());
    }

    /**
     * @param Ingredient $ingredient
     * @return Cocktail[]
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchCocktailsByIngredient(Ingredient $ingredient): array
    {
        $ingredientName = $ingredient->getName();
        $response = $this->fetchRequest("filter.php/?i=$ingredientName");

        return $this->converter->convertToCocktails($response->getContent());
    }

    //</editor-fold>

    //<editor-fold desc="Ingredient functions">

    /**
     * @param int $id
     * @return Ingredient|null
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchIngredientById(int $id): ?Ingredient
    {
        $response = $this->fetchRequest("lookup.php?iid=$id");
        $content = $response->toArray();

        return $this->converter->convertToIngredient($response->getContent());
    }

    /**
     * @param string $name
     * @return Ingredient|null
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchIngredientByName(string $name): ?Ingredient
    {
        $response = $this->fetchRequest("search.php?i=$name");
        $content = $response->toArray();

        //TODO: implement ingredient data parser
        return $this->converter->convertToIngredient($response->getContent());
    }

    //TODO: write more functions for cocktail ingredients

    //</editor-fold>

    //<editor-fold desc="utility functions">

    /**
     * @param string $path
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    private function fetchRequest(string $path): ResponseInterface
    {
        //generate request to access API
        return $this->client->request(
            'GET',
            self::SOURCE . $path,
        );
    }
    //</editor-fold>



}
