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

    private function isPartNumber(int $number, $x, $y): bool
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

        // if ($number === 467) {
        //     dd(
        //         $aboveBits,
        //         $leftBit.$number.$rightBit,
        //         $belowBits,
        //         $leftBit !== '.',
        //         $rightBit !== '.',
        //         preg_match("/[^.\d]/", $aboveBits) === 1,
        //         preg_match("/[^.\d]/", $belowBits) === 1,
        //     );
        // }

        return $leftBit !== '.'
            || $rightBit !== '.'
            || preg_match("/[^.\d]/", $aboveBits) === 1
            || preg_match("/[^.\d]/", $belowBits) === 1
        ;
    }

    public function secondPuzzle(): int
    {
        return 0;
    }
}
