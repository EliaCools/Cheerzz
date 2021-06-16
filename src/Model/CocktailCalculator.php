<?php
declare(strict_types=1);

namespace App\Model;

use App\Entity\Cocktail;
use http\Exception\InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

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
    public function CalculateIngredientQuantities(Cocktail $cocktail) : array
    {
        $ingredients = $cocktail->getIngredientsAndMeasurements();
        $quantities = [];
        foreach($ingredients AS $ingredient)
        {
            $name = $ingredient[0];
            $strAmount = $ingredient[1];

            $quantities[] = new Quantity($name,$this->calculateMeasurement($strAmount));
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

    public function calculateMeasurement(string $input): float
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

            if (in_array($chunk, self::MEASUREMENTS))
            {
                return match (strtolower($chunk))
                {
                    'ml' => $value,
                    'cl' => $value * .1,
                    'l' => $value * .001,
                    'oz' => $this->convertOunceToMl($value),
                    'tsp' => $this->convertTeaspoonToMl($value),
                    'tbsp' => $this->convertTableSpoonToMl($value),
                    'shot' => $this->convertShotToMl($value),
                    default => $value,
                };
            }
        }
        return $value;
    }

    //</editor-fold>
}