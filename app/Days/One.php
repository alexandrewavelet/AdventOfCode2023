<?php

namespace App\Days;

use NumberFormatter;

class One extends Day
{
    public string $title = 'Trebuchet?!';
    public string $description = 'Find calibration value for the launch.';

    public function firstPuzzle(): int
    {
        return (int)$this->dataset->sum(function ($value) {
            return preg_replace_callback(
                "/(\D)*(?'firstDigit'\d)(.*(?'lastDigit'\d))?(\D)*/",
                fn ($m) => $m['firstDigit'].($m['lastDigit'] ?: $m['firstDigit']),
                $value,
                flags: PREG_UNMATCHED_AS_NULL
            );
        });
    }

    public function secondPuzzle(): int
    {
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);

        return (int)$this->dataset
            ->sum(function ($value) use ($formatter) {
                $digits = [];
                preg_match(
                    "/(?'firstDigit'\d|one|two|three|four|five|six|seven|eight|nine)(.*(?'lastDigit'(?&firstDigit)))?/",
                    $value,
                    $digits,
                    flags: PREG_UNMATCHED_AS_NULL
                );

                $tens = $formatter->parse($digits['firstDigit'], NumberFormatter::TYPE_INT32);
                $units = $formatter->parse(
                    $digits['lastDigit'] ?? $digits['firstDigit'],
                    NumberFormatter::TYPE_INT32
                );

                return $tens * 10 + $units;
            });
    }
}
