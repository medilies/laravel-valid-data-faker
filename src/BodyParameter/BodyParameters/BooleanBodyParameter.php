<?php

namespace Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters;

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameter;

class BooleanBodyParameter extends BodyParameter
{
    public function generate(): bool
    {
        return true;
    }
}
