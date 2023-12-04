<?php

namespace App\Days;

class Four extends Day
{
    public string $title = 'Scratchcards';
    public string $description = 'Help an elf chekc if they\'re winning.';

    public function firstPuzzle(): int
    {
        return $this->dataset->reduce(function ($carry, $scratchcard) {
            $game = array_combine(
                ['game', 'winners', 'scratched'],
                preg_split("/[:|]+/", $scratchcard)
            );
            $winners = preg_split("/[\s]+/", trim($game['winners']));
            $scratched = preg_split("/[\s]+/", trim($game['scratched']));

            $scratchedWins = count(array_intersect($winners, $scratched));

            return $carry += ($scratchedWins > 0) ? pow(2, $scratchedWins - 1) : 0;
        }, 0);
    }

    public function secondPuzzle(): int
    {
        return 0;
    }
}
