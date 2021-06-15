<?php

namespace App\Model;

use App\Entity\Cocktail;
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




        foreach( $decoded -> drinks as $stdObject){
            $ingredients = [];


           for($i = 1; $i<15 ; $i++){

               $dynamic_var = 'strIngredient' . $i;

               $ingredients[][] = $stdObject-> $dynamic_var;
           }
           for($i = 1; $i<15 ; $i++){

               $dynamic_var = 'strMeasure' . $i;

               $ingredients[$i-1][] = $stdObject-> $dynamic_var;
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


    public function convertToSingleCocktail(string $fetchSingleCocktail) :  Cocktail
    {

        $decoded = json_decode($fetchSingleCocktail);

        $cocktails = [];

        foreach ($decoded->drinks as $stdObject)
        {

            $ingredients = [];

        // @ Todo get ingredients and measurements in multi dimensional array
            for($i = 1; $i<15 ; $i++){

                $dynamic_var = 'strIngredient' . $i;

                $ingredients[][] = $stdObject-> $dynamic_var;
            }
            for($i = 1; $i<15 ; $i++){

                $dynamic_var = 'strMeasure' . $i;

                $ingredients[$i-1][] = $stdObject-> $dynamic_var;
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

        return $cocktails[0];
    }


}
