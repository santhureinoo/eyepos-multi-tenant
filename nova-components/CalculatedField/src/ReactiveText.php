<?php

namespace Eyespos\CalculatedField;

use Eyespos\CalculatedField\Traits\ReactiveField;
use Laravel\Nova\Fields\Text;

class ReactiveText extends Text
{
    use ReactiveField;

    public $component = 'reactive-text-field';
}
