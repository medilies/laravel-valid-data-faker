<?php

namespace Elaboratecode\ValidDataFaker\ParameterFakers;

use stdClass;

class ParameterFakerFactory
{
    public function __construct()
    {
    }

    public function make(string $param_name, array $details)
    {
        return new stdClass;
    }
}
