<?php
declare(strict_types=1);

namespace App\Tests;
use App\Model\CocktailCalculator;
use http\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

//to run the tests, enter the following command into the terminal:
//./vendor/bin/phpunit
class CocktailCalculatorTest extends TestCase
{
    public function testFraction(): void
    {
        $calculator = new CocktailCalculator();
        self::assertEquals(.5,$calculator->fractionStringToFloat('1/2'));
        self::assertEquals(1,$calculator->fractionStringToFloat('2/2'));
        self::assertEquals(.25,$calculator->fractionStringToFloat('1/4'));
        self::assertEquals(2,$calculator->fractionStringToFloat('4/2'));

        self::assertEquals(0,$calculator->fractionStringToFloat('0/4'));
    }

    public function testMeasurementCalculation(): void
    {
        $calculator = new CocktailCalculator();
        self::assertEquals(1, $calculator->calculateMeasurement('1 ml'));
        self::assertEquals(1.5, $calculator->calculateMeasurement('1 1/2 ml'));
        self::assertEquals(2, $calculator->calculateMeasurement('1 1/2 2/4 ml'));

        self::assertEquals(29.57, $calculator->calculateMeasurement('1 oz'));
        self::assertEquals(14.79, $calculator->calculateMeasurement('1 tbsp'));
        self::assertEquals(4.93, $calculator->calculateMeasurement('1 tsp'));
        self::assertEquals(44.36, $calculator->calculateMeasurement('1 shot'));
    }
}