<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker;

use Elaboratecode\ValidDataFaker\ParameterFaker\Concerns\WithFaker;
use Illuminate\Validation\ValidationRuleParser;

abstract class ParameterFaker
{
    protected array $parsed_rules;

    protected array $rules;

    public function __construct(
        protected string $param_name,
        array $rules,
    ) {
        $this->setUpTraits();

        $this->parsed_rules = array_map(ValidationRuleParser::class.'::parse', $rules);

        // pascal case to snake case
        $this->rules = array_map(fn ($parsed_rule) => strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $parsed_rule[0])), $this->parsed_rules);
    }

    protected function setUpTraits()
    {
        $uses = array_flip(class_uses_recursive(static::class));

        if (isset($uses[WithFaker::class])) {
            $this->setUpFaker();
        }

        foreach ($uses as $trait) {
            if (method_exists($this, $method = 'setUp'.class_basename($trait))) {
                $this->{$method}();
            }

            // if (method_exists($this, $method = 'tearDown' . class_basename($trait))) {
            //     $this->beforeApplicationDestroyed(fn () => $this->{$method}());
            // }
        }

        return $uses;
    }

    abstract public function generate();

    protected function injectRule(string $rule, array $parameters = []): void
    {
        $this->rules[] = $rule;
        $this->parsed_rules[] = [$rule, $parameters];
    }
}
