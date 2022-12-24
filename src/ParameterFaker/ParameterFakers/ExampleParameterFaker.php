<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers;

use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFaker;

class ExampleParameterFaker extends ParameterFaker
{
    public function __construct(
        protected string $param_name,
        protected mixed $example,
    ) {
    }

    public function generate(): mixed
    {
        return $this->example;
    }
}
