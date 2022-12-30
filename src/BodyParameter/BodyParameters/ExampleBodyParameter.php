<?php

namespace Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters;

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameter;

class ExampleBodyParameter extends BodyParameter
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
