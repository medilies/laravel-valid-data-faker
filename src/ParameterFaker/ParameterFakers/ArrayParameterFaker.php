<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers;

use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFaker;

class ArrayParameterFaker extends ParameterFaker
{
    public function __construct(
        string $param_name,
        array $rules,
        protected array $children,
    ) {
        parent::__construct($param_name, $rules);
    }

    public function generate(): array
    {
        return [];
    }
}
