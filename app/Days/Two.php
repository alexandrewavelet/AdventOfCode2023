<?php

namespace App\Days;

class Two extends Day
{
    public string $title = 'Cube Conundrum';
    public string $description = 'Play the cube game with the elf.';

    public function firstPuzzle(): int
    {
        return $this->dataset
            ->filter(function ($value) {
                $matches = [];
                preg_match_all(
                    "/(?'red'\d+) red|(?'blue'\d+) blue|(?'green'\d+) green/",
                    $value,
                    $matches,
                );

                return max($matches['red'] ?? []) <= 12
                    && max($matches['green'] ?? []) <= 13
                    && max($matches['blue'] ?? []) <= 14;
            })
            ->sum(fn ($v) => (int)preg_replace("/[\D]*(\d+):.*/", '$1', $v));
    }

    public function secondPuzzle(): int
    {
        return $this->dataset->sum(function ($value) {
            return 1;
        });
    }
}
