<?php


namespace App\Model;


use function PHPUnit\Framework\stringContains;

class fractionsToDec
{
    public function fracToDec(array $measures): array
    {
        $total = 0;
        foreach ($measures as &$measure) {

            $measure = str_ireplace("part", 'part', $measure);
            $measure = str_ireplace("parts", 'part', $measure);

            if (stringContains($measure, 'part')) {
                $array = explode(' ', $measure);
                foreach ($array as $data) {
                    if (is_numeric($data)) {
                        $total += $data;
                    }
                }
                $measure = implode(' ', $array);
            }
        }
        unset($measure);

        if ($total === 0) {
            return $measures;
        }

        foreach ($measures as &$measure) {
            if (str_contains($measure, "part")) {
                $array = explode(' ', $measure);
                foreach ($array as &$value) {
                    if (is_numeric($value)) {
                        $value = number_format($value / $total, 2);
                    }
                }
                unset($value);
                $measure = implode(' ', $array);
            }
        }
        unset($measure);

        return $measures;
    }
}
