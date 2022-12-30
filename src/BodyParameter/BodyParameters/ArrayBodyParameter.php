<?php

namespace Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters;

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameter;

class ArrayBodyParameter extends BodyParameter
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
