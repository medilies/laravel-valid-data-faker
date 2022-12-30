<?php

namespace Elaboratecode\ValidDataFaker\BodyParameter;

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\ArrayBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\BooleanBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\ExampleBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\FileBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\IntegerBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\NumericBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\StringBodyParameter;
use Elaboratecode\ValidDataFaker\Exceptions\BodyParameterInstanciationException;

class BodyParameterFactory
{
    // ! readonly
    protected array $type_rules = ['array', 'boolean', 'file', 'integer', 'numeric', 'string'];

    public function make(
        string $param_name,
        array $rules,
        ?array $children = null,
        mixed $example = null,
    ): BodyParameter {
        if (! is_null($example)) {
            return new ExampleBodyParameter($param_name, $example);
        }

        $type_rules = array_values(array_intersect($rules, $this->type_rules));
        $type_rules_count = count($type_rules);

        if ($type_rules_count > 1) {
            // TODO: check parent type (numeric -> integer)
            $this->throw('Conflict between many data type rules');
        } elseif ($type_rules_count === 0) {
            $this->throw('No data type rule was detected');
        }

        if ($type_rules[0] === 'array') {
            return new ArrayBodyParameter($param_name, $rules, $children);
        }

        if (! is_null($children)) {
            $this->throw("children must not be set when the parameter isn't an array");
        }

        return match ($type_rules[0]) {
            'boolean' => new BooleanBodyParameter($param_name, $rules),
            'file' => new FileBodyParameter($param_name, $rules),
            'integer' => new IntegerBodyParameter($param_name, $rules),
            'numeric' => new NumericBodyParameter($param_name, $rules),
            'string' => new StringBodyParameter($param_name, $rules),
            default => $this->throw('Unmatched concrete ParamFaker'),
        };
    }

    protected function throw(string $message = ''): void
    {
        throw new BodyParameterInstanciationException($message);
    }
}
