<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Cocktail;
use http\Exception\InvalidArgumentException;

class CocktailCalculator
{
    private const MEASUREMENTS = ['ml', 'cl', 'l', 'oz', 'tbsp', 'tsp', 'shot'];
    private const OUNCE_TO_ML = 29.57;
    private const TSP_TO_ML = 4.93;
    private const TBSP_TO_ML = 14.79;
    private const SHOT_TO_ML = 44.36;

    /**
     * @param Cocktail $cocktail
     * @return Quantity[]
     */
    public function CalculateIngredientQuantities(Cocktail $cocktail): array
    {
        $ingredients = $cocktail->getIngredientsAndMeasurements();
        $quantities = [];
        foreach ($ingredients as $ingredient)
        {
            $name = $ingredient[0];
            $strAmount = $ingredient[1];

            $quantities[] = new Quantity($name, $this->calculateMeasurement($strAmount));
        }
        return $quantities;
    }

    //<editor-fold desc="Conversion functions">

    private function convertOunceToMl(float $ounces): float
    {
        return $ounces * self::OUNCE_TO_ML;
    }

    private function convertTeaspoonToMl(float $tsp): float
    {
        return $tsp * self::TSP_TO_ML;
    }

    private function convertTableSpoonToMl(float $tbsp): float
    {
        return $tbsp * self::TBSP_TO_ML;
    }

    private function convertShotToMl(float $shot): float
    {
        return $shot * self::SHOT_TO_ML;
    }

    public function fractionToFloat(int $numerator, int $denominator): float
    {
        if ($denominator === 0)
        {
            throw new InvalidArgumentException('division by zero!');
        }
        return $numerator / $denominator;
    }

    public function fractionStringToFloat(string $fraction): float
    {
        $values = explode('/', $fraction, 3);
        return $this->fractionToFloat((int)$values[0], (int)$values[1]);
    }

    public function calculateMeasurement(string $input, int $total = 1): float
    {
        $data = explode(" ", $input);

        $value = 0;

        foreach ($data as $chunk)
        {
            if (is_numeric($chunk))
            {
                $value += (int)$chunk;
                continue;
            }

            if (preg_match("/[1-9][0-9]*\/[1-9][0-9]*/", $chunk))
            {
                $value += $this->fractionStringToFloat($chunk);
                continue;
            }

            if (in_array($chunk, self::MEASUREMENTS, false))
            {
                switch ($chunk)
                {
                    case 'ml':
                    default:
                        return $value;
                    case 'cl':
                        return $value * .1;
                    case 'l':
                        return $value * .001;
                    case 'oz':
                        return $this->convertOunceToMl($value);
                    case 'tsp':
                        return $this->convertTeaspoonToMl($value);
                    case 'tbsp':
                        return $this->convertTableSpoonToMl($value);
                    case 'shot':
                        return $this->convertShotToMl($value);
                }
            }
        }
        //TODO: make it so the calculator takes in the volume of a glass, and, if it gets to this point, calculates
        //      the relative value of the glass' contents.

        //      if the code gets to this point, it has only found numerical values, but no quantity identifier.
        //      this means that it is trying to show a fraction of a total value, a percentage if you will.
        //      as such, it might be expedient to take in the total value, and return the relative value.
        //      normally, the value at this point should be a total value less than 1. if it is above 1, the
        //      glass ought to run over, so that shouldn't happen. But that sounds more like an API problem than
        //      one we should fix.
        return $value * $total;
    }

    //</editor-fold>
}