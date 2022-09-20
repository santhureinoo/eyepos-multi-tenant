<?php

namespace Eyespos\CalculatedField;

use Eyespos\CalculatedField\Traits\ReactiveField;
use Laravel\Nova\Fields\Select;

class ReactiveSelect extends Select
{
    use ReactiveField;

    public $component = 'reactive-select-field';
}
