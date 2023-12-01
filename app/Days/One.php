<?php

namespace App\Days;

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

    public function secondPuzzle(): string
    {
        return 'TBD';
    }
}
