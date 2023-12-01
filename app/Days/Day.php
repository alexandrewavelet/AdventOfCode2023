<?php

namespace App\Days;

use Illuminate\Support\Collection;

abstract class Day
{
    public string $title = '';
    public string $description = '';

    /** @var Collection<string> */
    protected Collection $dataset;

    public function __construct($dataset = null)
    {
        $this->dataset = $dataset instanceof Collection
            ? $dataset
            : collect(preg_split(
                $this->getSplitDelimiterForDataset(),
                $dataset ?? ''
            ));

        if (!$this->dataset->last()) {
            $this->dataset->pop();
        }
    }

    abstract public function firstPuzzle(): mixed;

    abstract public function secondPuzzle(): mixed;

    protected function getSplitDelimiterForDataset(): string
    {
        return '/\r\n|\r|\n/';
    }
}
