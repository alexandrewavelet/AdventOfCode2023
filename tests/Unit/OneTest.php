<?php

namespace Tests\Unit;

use App\Days\One;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class OneTest extends TestCase
{
    /**
     * @test
     */
    public function it_finds_calibration(): void
    {
        $day = new One(new Collection([
            '1abc2',
            'pqr3stu8vwx',
            'a1b2c3d4e5f',
            'treb7uchet',
        ]));

        $this->assertSame(142, $day->firstPuzzle());
    }

    /**
     * @test
     */
    public function it_finds_calibration_with_lettered_digits(): void
    {
        $day = new One(new Collection([
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
