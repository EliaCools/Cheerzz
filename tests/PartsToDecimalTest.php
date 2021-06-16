<?php


namespace App\Tests;


use App\Model\fractionsToDec;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\stringContains;

class PartsToDecimalTest extends TestCase
{
    public function dataProviderForReturnTotal(): array
    {
        return [
            [[0 => '3 parts', 1 => '5 parts'], [0 => '0.38 part', 1 => '0.63 part']],
            [[0 => '1 part', 1 => '2 parts'], [0 => '0.33 part', 1 => '0.67 part']],
            [[0 => '1 Part', 1 => '2 Parts'], [0 => '0.33 part', 1 => '0.67 part']],
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderForReturnTotal
     */
    public function testReturnTotal(array $measures, $result): void
    {
        $calc = new fractionsToDec();
        $measures = $calc->fracToDec($measures);
        self::assertSame($measures, $result);
    }
}
