<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers;

use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFaker;

class IntegerParameterFaker extends ParameterFaker
{
    public function generate(): int
    {
        return 1;
    }
}
