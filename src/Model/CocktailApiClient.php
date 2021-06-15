<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Cocktail;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CocktailApiClient
{
    private HttpClientInterface $client;
    private const SOURCE = 'https://www.thecocktaildb.com/api/json/v1/1/';

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

    public function fetchCocktailsByFirstLetter(string $character): array
    {
        //generate request to access API
        $response = $this->client->request(
            'GET',
            self::SOURCE . 'search.php?f=a',
        );

        //receive request and convert to JSON associative array
        $statusCode = $response->getStatusCode();
        $contentType = $response->getHeaders()['content-type'][0];
        $content = $response->toArray();

        $cocktails = [];
        $testString = "";
        foreach ($content['drinks'] as $item)
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
}