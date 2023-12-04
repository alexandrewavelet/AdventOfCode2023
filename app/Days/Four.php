<?php

namespace App\Days;

class Four extends Day
{
    public string $title = 'Scratchcards';
    public string $description = 'Help an elf chekc if they\'re winning.';

    public function firstPuzzle(): int
    {
        return $this->dataset->reduce(function ($carry, $scratchcard) {
            $scratchedWins = $this->getWins($scratchcard);

            return $carry += ($scratchedWins > 0) ? pow(2, $scratchedWins - 1) : 0;
        }, 0);
    }

    public function secondPuzzle(): int
    {
        $numberOfCards = $this->dataset
            ->map(fn () => 1)
            ->toArray();

        $this->dataset->each(function ($scratchcard, $key) use (&$numberOfCards) {
            $scratchedWins = $this->getWins($scratchcard);

            for ($i = 0; $i < $scratchedWins; $i++) {
                $numberOfCards[$key + $i + 1] += $numberOfCards[$key];
            }
        });

        return array_sum($numberOfCards);
    }

    private function getWins(string $scratchcard): int
    {
        $game = array_combine(
            ['game', 'winners', 'scratched'],
            preg_split("/[:|]+/", $scratchcard)
        );
        $winners = preg_split("/[\s]+/", trim($game['winners']));
        $scratched = preg_split("/[\s]+/", trim($game['scratched']));

        return count(array_intersect($winners, $scratched));
    }
}
