<?php

namespace Tests\Unit;

use App\Days\Three;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class ThreeTest extends TestCase
{
    /**
     * @test
     */
    public function it_sums_part_numbers(): void
    {
        $day = new Three(new Collection([
            '467..114..',
            '...*......',
            '..35..633.',
            '......#...',
            '617*......',
            '.....+.58.',
            '..592.....',
            '......755.',
            '...$.*....',
            '.664.598..',
        ]));

        $this->assertSame(4361, $day->firstPuzzle());
    }

    /**
     * @test
     */
    public function it_xxx(): void
    {
        $this->markTestSkipped();
    }
}
