<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers;

use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFaker;

class NumericParameterFaker extends ParameterFaker
{
    public function generate(): int|float
    {
        return 1;
    }
}
