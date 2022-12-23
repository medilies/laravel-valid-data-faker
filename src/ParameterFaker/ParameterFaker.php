<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker;

use Illuminate\Validation\ValidationRuleParser;

abstract class ParameterFaker
{
    protected array $rules;

    public function __construct(
        protected string $param_name,
        array $rules,
    ) {
        $this->rules = array_map(ValidationRuleParser::class.'::parse', $rules);
    }
}
