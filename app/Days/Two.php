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

                return (int)max($matches['red']) <= 12
                    && (int)max($matches['green']) <= 13
                    && (int)max($matches['blue']) <= 14;
            })
            ->sum(fn ($v) => (int)preg_replace("/[\D]*(\d+):.*/", '$1', $v));
    }

    public function secondPuzzle(): int
    {
        return $this->dataset->reduce(function ($carry, $value) {
            $matches = [];
            preg_match_all(
                "/(?'red'\d+) red|(?'blue'\d+) blue|(?'green'\d+) green/",
                $value,
                $matches,
            );

            return (int)max($matches['red'])
                * (int)max($matches['green'])
                * (int)max($matches['blue'])
                + $carry;
        });
    }
}
