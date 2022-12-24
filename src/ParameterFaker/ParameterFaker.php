<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker;

use Illuminate\Validation\ValidationRuleParser;

abstract class ParameterFaker
{
    protected array $parsed_rules;

    protected array $rules;

    public function __construct(
        protected string $param_name,
        array $rules,
    ) {
        $this->parsed_rules = array_map(ValidationRuleParser::class.'::parse', $rules);

        // pascal case to snake case
        $this->rules = array_map(fn ($parsed_rule) => strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $parsed_rule[0])), $this->parsed_rules);
    }

    abstract public function generate();
}
