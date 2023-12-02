<?php

namespace Tests\Unit;

use App\Days\Two;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class TwoTest extends TestCase
{
    /**
     * @test
     */
    public function it_finds_valid_games(): void
    {
        $day = new Two(new Collection([
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green',
            'Game 6: 6 red; 7 red; 8 red',
        ]));

        $this->assertSame(14, $day->firstPuzzle());
    }

    /**
     * @test
     */
    public function it_finds_xxx(): void
    {
        $this->markTestSkipped();

        $day = new Two(new Collection([
            'two1nine',
            'eightwothree',
            'abcone2threexyz',
            'xtwone3four',
            '4nineeightseven2',
            'zoneight234',
            '7pqrstsixteen',
            'ntxmgvkm9',
        ]));

        $this->assertSame(380, $day->secondPuzzle());
    }
}
