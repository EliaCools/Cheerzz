<?php
declare(strict_types=1);
namespace App\Model;

use App\Entity\Cocktail;
use App\Entity\Ingredient;
use App\Model\CocktailApiClient;

class JsonToObject
{

    /**
     * @return Cocktail[]
     */
    public function convertToCocktails(string $fetchMultiple): array
    {
        $cocktails = [];
        $decoded = json_decode($fetchMultiple);
        $ingredients = [];

        foreach ($decoded->drinks as $stdObject)
        {
            //this should get the ingredients from the stdObject
               for($i = 1; $i<=15 ; $i++){
                   $ingredients[] = [$stdObject->strIngredient . $i, $stdObject->strMeasure . $i];
               }

            if ($stdObject->strAlcoholic === 'Alcoholic')
            {
                $stdObject->strAlcoholic = true;
            }

            $cocktails[] = new Cocktail(
                $stdObject->idDrink,
                $stdObject->strDrink,
                $stdObject->strDrinkThumb,
                $stdObject->strCategory,
                $stdObject->strGlass,
                $ingredients,
                $stdObject->strInstructions,
                $stdObject->strAlcoholic);
        }

        return $cocktails;
    }

    /**
     * @param string $fetchSingleCocktail
     * @return Cocktail
     */
    public function convertToCocktail(string $fetchSingleCocktail): Cocktail
    {

        $decoded = json_decode($fetchSingleCocktail);
        $ingredients = [];
        $cocktails = [];

        foreach ($decoded->drinks as $stdObject)
        {

            // @ Todo get ingredients and measurements in multi dimensional array
            //   for($i = 0; $i<15 ; $i++){
            //       $ingredients[] = $stdObject-> strIngredient . $i;
            //   }

            if ($stdObject->strAlcoholic === 'Alcoholic')
            {
                $stdObject->strAlcoholic = true;
            }


            $cocktails[] = new Cocktail(
                $stdObject->idDrink,
                $stdObject->strDrink,
                $stdObject->strDrinkThumb,
                $stdObject->strCategory,
                $stdObject->strGlass,
                $ingredients,
                $stdObject->strInstructions,
                $stdObject->strAlcoholic);
        }

        return $cocktails[0];
    }

    public function convertToIngredient(string $fetchSingleIngredient) : Ingredient
    {
        //TODO: implement proper Json string to Ingredient function.

        return new Ingredient(0, "", "", false, "");
    }


}
