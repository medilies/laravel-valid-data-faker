<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker;

abstract class ParameterFaker
{
    public function __construct(
        protected string $param_name,
        protected array $rules,
        protected ?array $children = null
    ) {
    }
}
