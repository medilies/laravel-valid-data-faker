<?php

namespace Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters;

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameter;

class IntegerBodyParameter extends BodyParameter
{
    public function generate(): int
    {
        return 1;
    }
}
