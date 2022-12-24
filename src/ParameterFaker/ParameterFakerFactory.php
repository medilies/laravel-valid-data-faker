<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker;

use Elaboratecode\ValidDataFaker\Exceptions\ParameterFakerInstanciationException;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\ArrayParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\BooleanParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\FileParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\IntegerParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\NumericParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\StringParameterFaker;

class ParameterFakerFactory
{
    // ! readonly
    protected array $type_rules = ['array', 'boolean', 'file', 'integer', 'numeric', 'string'];

    public function make(string $param_name, array $rules, ?array $children = null): ParameterFaker
    {
        $type_rules = array_values(array_intersect($rules, $this->type_rules));
        $type_rules_count = count($type_rules);

        if ($type_rules_count > 1) {
            // TODO: check parent type (numeric -> integer)
            throw new ParameterFakerInstanciationException('Conflict between many data type rules');
        } elseif ($type_rules_count === 0) {
            throw new ParameterFakerInstanciationException('No data type rule was detected');
        }

        if ($type_rules[0] === 'array') {
            return new ArrayParameterFaker($param_name, $rules, $children);
        }

        if (! is_null($children)) {
            throw new ParameterFakerInstanciationException("children must not be set when the parameter isn't an array");
        }

        return match ($type_rules[0]) {
            'boolean' => new BooleanParameterFaker($param_name, $rules),
            'file' => new FileParameterFaker($param_name, $rules),
            'integer' => new IntegerParameterFaker($param_name, $rules),
            'numeric' => new NumericParameterFaker($param_name, $rules),
            'string' => new StringParameterFaker($param_name, $rules),
        };
    }
}
