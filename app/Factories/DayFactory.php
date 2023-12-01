<?php

namespace App\Factories;

use App\Days\Day;
use Exception;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class DayFactory
{
    public static function create(int $number): Day
    {
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);

        $class = 'App\Days\\' . self::toPascalCase($formatter->format($number));
        throw_if(
            !class_exists($class),
            new Exception('Day ' . $number . ' does not exists')
        );

        $storage = Storage::disk('days');
        $file = $number . '.txt';
        throw_if(
            $storage->missing($file),
            new Exception('Day ' . $number . ' does not have a dataset')
        );

        $dataset = $storage->get($file);

        return new $class($dataset);
    }

    private static function toPascalCase(string $string): string
    {
        return str_replace(' ', '', ucwords($string));
    }
}
