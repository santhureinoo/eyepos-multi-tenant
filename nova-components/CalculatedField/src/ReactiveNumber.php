<?php

namespace Eyespos\CalculatedField;

use Eyespos\CalculatedField\Traits\ReactiveField;
use Laravel\Nova\Fields\Number;

class ReactiveNumber extends Number
{
    use ReactiveField;

    public $component = 'reactive-number-field';
}
