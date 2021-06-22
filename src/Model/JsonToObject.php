<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Cocktail;
use App\Entity\Ingredient;
use App\Model\CocktailApiClient;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpClient\Exception\JsonException;

class JsonToObject
{
    #region constants
    //constants for navigating the API's cocktail Json
    private const DRINKS = 'drinks';
    private const STR_ID = 'idDrink';
    private const STR_NAME = 'strDrink';
    private const STR_INGREDIENT = 'strIngredient';
    private const STR_AMOUNT = 'strMeasure';
    private const STR_ALCOHOLIC = 'strAlcoholic';
    private const STR_IMAGE = 'strDrinkThumb';
    private const STR_GLASS = 'strGlass';
    private const STR_CATEGORY = 'strCategory';
    private const STR_INSTRUCTIONS = 'strInstructions';

    //constants for navigating the API's ingredient Json
    private const INGREDIENTS = 'ingredients';
    private const STR_ID_INGREDIENT = 'idIngredient';
    private const STR_NAME_INGREDIENT = 'strIngredient';
    private const STR_DESCRIPTION_INGREDIENT = 'strDescription';
    private const STR_TYPE_INGREDIENT = 'strType';
    private const STR_ALCOHOLIC_INGREDIENT = 'strAlcohol';

    #endregion

    #region Cocktail Conversion
    /**
     * @param string $jsonMultiple
     * @return Cocktail[]
     * @throws \JsonException
     */
    public function convertToCocktails(string $jsonMultiple): array
    {
        $cocktails = [];
        $decoded = json_decode($jsonMultiple, true, 512, JSON_THROW_ON_ERROR);

        if(isset($decoded[self::DRINKS]))
        {
            foreach ($decoded[self::DRINKS] as $item)
            {
                $cocktails[] = $this->convertArrayToCocktail($item);
            }
        }
        return $cocktails;
    }

    /**
     * @param string $jsonSingle
     * @return Cocktail
     * @throws \JsonException
     */
    public function convertToCocktail(string $jsonSingle): ?Cocktail
    {
        $decoded = json_decode($jsonSingle, true, 512, JSON_THROW_ON_ERROR);

        if($decoded[self::DRINKS] === null)
        {
            return null;
        }
        return $this->convertArrayToCocktail($decoded[self::DRINKS]['0']);
    }

    /**
     * @param array $decodedJson
     * @return Cocktail
     */
    #[Pure] private function convertArrayToCocktail(array $decodedJson) : Cocktail
    {
        $isAlcoholic = strtolower($decodedJson[self::STR_ALCOHOLIC]) === 'alcoholic';
        $ingredients = [];

        //this should get the ingredients from the stdObject, and convert it to a 2 dimensional array
        //TODO: maybe convert this into an array of objects? might be cleaner.
        for ($i = 1; $i <= 15; $i++)
        {
            if (empty($decodedJson[self::STR_INGREDIENT . $i]))
            {
                break;
            }
            $ingredients[] = [$decodedJson[self::STR_INGREDIENT . $i], $decodedJson[self::STR_AMOUNT . $i]];
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

    #endregion

    #region Ingredient Conversion
    /**
     * @param string $jsonSingle
     * @return Ingredient|null
     * @throws \JsonException
     */
    public function convertToIngredient(string $jsonSingle): ?Ingredient
    {
        $decoded = json_decode($jsonSingle, true, 512, JSON_THROW_ON_ERROR);

        if($decoded[self::INGREDIENTS] === null)
        {
            return null;
        }
        return $this->convertArrayToIngredient($decoded[self::INGREDIENTS]['0']);
    }

    /**
     * @param string $jsonMultiple
     * @return array
     * @throws \JsonException
     */
    public function convertToIngredients(string $jsonMultiple): array
    {
        $decoded = json_decode($jsonMultiple, true, 512, JSON_THROW_ON_ERROR);
        $ingredients = [];

        foreach($decoded[self::INGREDIENTS] as $item)
        {
            $ingredients[] = $this->convertArrayToIngredient($item);
        }

        return $ingredients;
    }

    /**
     * @param array $decodedJson
     * @return Ingredient
     */
    #[Pure] private function convertArrayToIngredient(array $decodedJson) : ?Ingredient
    {
        $isAlcoholic = strtolower((string)$decodedJson[self::STR_ALCOHOLIC_INGREDIENT]) === 'yes';

        return new Ingredient(
            $decodedJson[self::STR_ID_INGREDIENT],
            $decodedJson[self::STR_NAME_INGREDIENT],
            $decodedJson[self::STR_DESCRIPTION_INGREDIENT],
            $isAlcoholic,
            $decodedJson[self::STR_TYPE_INGREDIENT]
        );
    }

    #endregion

}
