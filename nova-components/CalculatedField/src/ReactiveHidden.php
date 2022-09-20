<?php

namespace Eyespos\CalculatedField;

use Eyespos\CalculatedField\Traits\ReactiveField;
use Laravel\Nova\Fields\Hidden;

class ReactiveHidden extends Hidden
{
    use ReactiveField;

    public $component = 'reactive-hidden-field';
}
