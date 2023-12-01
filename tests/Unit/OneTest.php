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
    public function it_finds_sum_of_all_calibrations(): void
    {
        $day = new One(new Collection([
            '1abc2',
            'pqr3stu8vwx',
            'a1b2c3d4e5f',
            'treb7uchet',
        ]));

        $this->assertSame(142, $day->firstPuzzle());
    }
}
