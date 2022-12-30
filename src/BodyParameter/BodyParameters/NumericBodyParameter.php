<?php

namespace Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters;

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameter;

class NumericBodyParameter extends BodyParameter
{
    public function generate(): int|float
    {
        return 1;
    }
}
