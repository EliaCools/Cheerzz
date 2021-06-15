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
    private const SOURCE = 'https://www.thecocktaildb.com/api/json/v1/1/';

    private const DRINKS = 'drinks';
    private const STR_ID = 'idDrink';
    private const STR_NAME = 'strDrink';
    private const STR_ALCOHOLIC = 'strAlcoholic';
    private const STR_IMAGE = 'strThumb';
    private const STR_GLASS = 'strGlass';
    private const STR_CATEGORY = 'strCategory';
    private const STR_INSTRUCTIONS = 'strInstructions';
    //TODO: add instruction string suffixes for other languages at some point.

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    //<editor-fold desc="Cocktail Functions">

    /**
     * @param string $character
     * @return cocktail[]
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchCocktailsByFirstLetter(string $character): array
    {
        $response = $this->fetchRequest("search.php?f=$character");

        //receive request and convert to JSON associative array
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->toArray();

        $cocktails = [];
        $testString = "";
        foreach ($content[self::DRINKS] as $item)
        {
            $name = $item[self::STR_NAME];
            $id = $item[self::STR_ID];
            $isAlcoholic = $this->parseIsAlcoholic($item[self::STR_ALCOHOLIC]);
            $imageLink = $item[self::STR_IMAGE];
            $glassType = $item[self::STR_GLASS];
            $category = $item[self::STR_CATEGORY];
            $instructions = $item[self::STR_INSTRUCTIONS];
            $cocktail = new Cocktail($id, $name, $imageLink, $category, $glassType, [], $instructions, $isAlcoholic);

            //TODO: add logic to add ingredients and quantities to the cocktail object.
            $testString .= $item['strDrink'] . " ";
        }

        return $cocktails;
    }

    /**
     * @param string $name
     * @return Cocktail|null
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchCocktailByName(string $name): ?Cocktail
    {
        $response = $this->fetchRequest("search.php?s=$name");

        //receive request and convert to JSON associative array
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->toArray();

        if($content[self::DRINKS] === null)
        {
            return null;
        }

        //TODO: return proper cocktail, not a null object.
        return new Cocktail("", "", "", "", "", [], "", false);
    }

    /**
     * @param int $id
     * @return Cocktail|null
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchCocktailById(int $id): ?Cocktail
    {
        $response = $this->fetchRequest("lookup.php?iid=$id");

        //receive request and convert to JSON associative array
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->toArray();

        if($content[self::DRINKS] === null)
        {
            return null;
        }

        //TODO: return proper cocktail, not a null object.
        return new Cocktail("", "", "", "", "", [], "", false);
    }

    /**
     * @return Cocktail
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchRandomCocktail() : Cocktail
    {
        $response = $this->fetchRequest("random.php");

        //receive request and convert to JSON associative array
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->toArray();

        //TODO: return proper cocktail, not a null object.
        return new Cocktail("", "", "", "", "", [], "", false);
    }

    /**
     * @param Ingredient $ingredient
     * @return Cocktail[]
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function fetchCocktailsByIngredient(Ingredient $ingredient) : array
    {
        $ingredientName = $ingredient->getName();
        $response = $this->fetchRequest("filter.php/?i=$ingredientName");

        //receive request and convert to JSON associative array
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->toArray();

        //TODO: return proper cocktail, not a null object.
        $cocktails = [];
        $cocktails[] = new Cocktail("", "", "", "", "", [], "", false);
        return $cocktails;
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

        //receive request and convert to JSON associative array
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->toArray();

        //TODO: implement ingredient data parser
        return new Ingredient(0,"","",false,"");
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

        //receive request and convert to JSON associative array
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->toArray();

        //TODO: implement ingredient data parser
        return new Ingredient(0,"","",false,"");
    }

    //TODO: write more functions for cocktail ingredients

    //</editor-fold>

    //<editor-fold desc="utility functions">

    /**
     * @param string $path
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     */
    private function fetchRequest(string $path) : ResponseInterface
    {
        //generate request to access API
        return $this->client->request(
            'GET',
            self::SOURCE . $path,
        );
    }

    /**
     * take in a string from the JSON that would denote whether a cocktail or ingredient is alcoholic, and returns a bool accordingly.
     * @param string $value
     * @return bool
     */
    private function parseIsAlcoholic(string $value): bool
    {
        switch (strtolower($value))
        {
            case "alcoholic":
                return true;
            case "non alcoholic":
                default:
                return false;
        }
    }

    //</editor-fold>
}