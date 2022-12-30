<?php

namespace Elaboratecode\ValidDataFaker\BodyParameter;

use Illuminate\Validation\ValidationRuleParser;

abstract class BodyParameter
{
    abstract public function generate();

    protected array $parsed_rules;

    protected array $rules;

    public function __construct(
        protected string $param_name,
        array $rules,
    ) {
        $this->setUpTraits();

        $this->parsed_rules = array_map(ValidationRuleParser::class.'::parse', $rules);

        $this->rules = array_column($this->parsed_rules, 0);
    }

    protected function setUpTraits()
    {
        $uses = array_flip(class_uses_recursive(static::class));

        foreach ($uses as $trait) {
            if (method_exists($this, $method = 'setUp'.class_basename($trait))) {
                $this->{$method}();
            }
        }

        return $uses;
    }

    protected function injectRule(string $rule, array $parameters = []): void
    {
        $this->rules[] = $rule;
        $this->parsed_rules[] = [$rule, $parameters];
    }
}
