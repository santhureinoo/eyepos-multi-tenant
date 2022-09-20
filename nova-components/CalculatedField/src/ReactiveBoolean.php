<?php

namespace Eyespos\CalculatedField;

use Eyespos\CalculatedField\Traits\ReactiveField;
use Laravel\Nova\Fields\Boolean;

class ReactiveBoolean extends Boolean
{
    use ReactiveField;

    public $component = 'reactive-boolean-field';
}
