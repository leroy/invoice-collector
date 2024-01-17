<?php

namespace App\Livewire\Synthesizers;

use Illuminate\Support\Carbon;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class CarbonSynthesizer extends Synth
{
    public static $key = 'carbon';

    static function match($target)
    {
        return $target instanceof \Illuminate\Support\Carbon;
    }

    public function dehydrate($value)
    {
        return $value->toDateTimeString();
    }

    public function hydrate($value)
    {
        return Carbon::parse($value);
    }
}
