<?php

namespace App\Console\Commands\Advent;

use App\Factories\DayFactory;
use Illuminate\Console\Command;

class SolveDay extends Command
{
    protected $signature = 'advent:day {day}';

    protected $description = 'Make base files for an advent day';

    protected int $day;

    public function handle(): int
    {
        try {
            $day = DayFactory::create($this->argument('day'));
        } catch (\Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info($day->title);
        $this->line($day->description);

        $this->newLine(2);

        $this->line("First puzzle solution: <info>{$day->firstPuzzle()}</info>");
        $this->line("Second puzzle solution: <info>{$day->secondPuzzle()}</info>");

        return self::SUCCESS;
    }
}
