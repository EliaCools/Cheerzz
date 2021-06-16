<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Cocktail;
use App\Entity\Ingredient;
use App\Model\CocktailApiClient;
use Symfony\Component\HttpClient\Exception\JsonException;

class JsonToObject
{
    private const DRINKS = 'drinks';
    private const STR_ID = 'idDrink';
    private const STR_NAME = 'strDrink';
    private const STR_INGREDIENT = 'strIngredient';
    private const STR_AMOUNT = 'strMeasure';
    private const STR_ALCOHOLIC = 'strAlcoholic';
    private const STR_IMAGE = 'strThumb';
    private const STR_GLASS = 'strGlass';
    private const STR_CATEGORY = 'strCategory';
    private const STR_INSTRUCTIONS = 'strInstructions';

    /**
     * @param string $jsonMultiple
     * @return Cocktail[]
     * @throws \JsonException
     */
    public function convertToCocktails(string $jsonMultiple): array
    {
        $cocktails = [];
        $decoded = json_decode($jsonMultiple, true, 512, JSON_THROW_ON_ERROR);

        foreach($decoded[self::DRINKS] as $item)
        {
            $cocktails[]= $this->convertArrayToCocktail($item);
        }
        return $cocktails;
    }

    /**
     * @param string $jsonSingle
     * @return Cocktail
     * @throws \JsonException
     */
    public function convertToCocktail(string $jsonSingle): Cocktail
    {
        $decoded = json_decode($jsonSingle, true, 512, JSON_THROW_ON_ERROR);

        return $this->convertArrayToCocktail($decoded[self::DRINKS][0]);
    }

    /**
     * @param array $decodedJson
     * @return Cocktail
     */
    private function convertArrayToCocktail(array $decodedJson) : Cocktail
    {
        $isAlcoholic = strtolower($decodedJson[self::STR_ALCOHOLIC]) === 'alcoholic';
        $ingredients = [];

        //this should get the ingredients from the stdObject, and convert it to a 2 dimensional array
        //TODO: maybe convert this into an array of objects? might be cleaner.
        for ($i = 1; $i <= 15; $i++)
        {
            $ingredients[] = [$decodedJson[self::STR_INGREDIENT] . $i, $decodedJson[self::STR_AMOUNT] . $i];
        }

        return new Cocktail(
            $decodedJson[self::STR_ID],
            $decodedJson[self::STR_NAME],
            $decodedJson[self::STR_IMAGE],
            $decodedJson[self::STR_CATEGORY],
            $decodedJson[self::STR_GLASS],
            $ingredients,
            $decodedJson[self::STR_INSTRUCTIONS],
            $isAlcoholic);
    }

    public function convertToIngredient(string $fetchSingleIngredient): Ingredient
    {
        //TODO: implement proper Json string to Ingredient function.

        return new Ingredient(0, "", "", false, "");
    }


}
