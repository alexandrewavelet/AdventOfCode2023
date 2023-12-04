<?php

namespace App\Days;

class Three extends Day
{
    public string $title = 'Gear Ratios';
    public string $description = 'Fix the lift engine parts.';

    public function firstPuzzle(): int
    {
        return $this->dataset->reduce(function ($carry, $row, $y) {
            $bits = str_split($row);
            $endOfRow = count($bits) - 1;
            $number = null;

            foreach ($bits as $x => $value) {
                if (is_numeric($value)) {
                    $number .= $value;

                    if ($x === $endOfRow) {
                        $this->isPartNumber($number, $x, $y)
                            && $carry += $number;

                        $number = null;
                    }
                } elseif ($number !== null) {
                    $this->isPartNumber($number, $x - 1, $y)
                        && $carry += $number;

                    $number = null;
                }
            }

            return $carry;
        }, 0);
    }

    private function isPartNumber(int $number, int $x, int $y): bool
    {
        $row = $this->dataset->get($y);
        $aboveRow = $this->dataset->get($y - 1, str_pad('', strlen($row), '.'));
        $belowRow = $this->dataset->get($y + 1, str_pad('', strlen($row), '.'));

        $leftX = $x - strlen($number);
        $rightX = $x + 1;

        $leftBit = $leftX >= 0 ? substr($row, $leftX, 1) : '.';
        $rightBit = $rightX < strlen($row) ? substr($row, $rightX, 1) : '.';
        $aboveBits = substr(
            $aboveRow,
            max(0, $leftX),
            strlen($number) + ($rightX < strlen($aboveRow) && $leftX >= 0 ? 2 : 1),
        );
        $belowBits = substr(
            $belowRow,
            max(0, $leftX),
            strlen($number) + ($rightX < strlen($belowRow) && $leftX >= 0 ? 2 : 1),
        );

        return $leftBit !== '.'
            || $rightBit !== '.'
            || preg_match("/[^.\d]/", $aboveBits) === 1
            || preg_match("/[^.\d]/", $belowBits) === 1
        ;
    }

    public function secondPuzzle(): int
    {
        return $this->dataset->reduce(function ($carry, $row, $y) {
            foreach (str_split($row) as $x => $value) {
                if ($value === '*') {
                    $adjacentParts = $this->findAdjacentParts($x, $y);

                    count($adjacentParts) === 2
                        && $carry += array_product($adjacentParts);
                }
            }

            return $carry;
        }, 0);
    }

    private function findAdjacentParts(int $x, int $y): array
    {
        $row = str_split($this->dataset->get($y));

        $leftX = max($x - 1, 0);
        $rightX = min($x + 1, count($row) - 1);

        return array_merge(
            $this->getNumbersInRange(str_split($this->dataset->get($y - 1)), $leftX, $rightX),
            $this->getNumbersInRange($row, $leftX, $rightX),
            $this->getNumbersInRange(str_split($this->dataset->get($y + 1)), $leftX, $rightX),
        );
    }

    private function getNumbersInRange(array $row, $lowerBound, $upperBound): array
    {
        if (empty($row)) {
            return [];
        }

        $numbers = [];
        $currentNumber = null;
        $numberInRange = false;

        foreach ($row as $key => $value) {
            if (is_numeric($value)) {
                $currentNumber .= $value;

                if ($key >= $lowerBound && $key <= $upperBound) {
                    $numberInRange = true;
                }
            } else {
                $numberInRange && $numbers[] = $currentNumber;

                $currentNumber = null;
                $numberInRange = false;
            }
        }

        $numberInRange && $numbers[] = $currentNumber;

        return $numbers;
    }
}
