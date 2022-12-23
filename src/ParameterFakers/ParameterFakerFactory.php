<?php

namespace Elaboratecode\ValidDataFaker\ParameterFakers;

use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\ArrayParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\BooleanParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\FileParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\IntegerParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\NumericParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\StringParameterFaker;
use Exception;

class ParameterFakerFactory
{
    protected $type_rules = ['array', 'boolean', 'file', 'integer', 'numeric', 'string'];

    public function __construct()
    {
    }

    public function make(string $param_name, array $details)
    {
        if (! array_key_exists('rules', $details)) {
            throw new Exception('No rules entry in parameter details');
        }

        $type_rules = array_values(array_intersect($details['rules'], $this->type_rules));
        $type_rules_count = count($type_rules);

        if ($type_rules_count > 1) {
            throw new Exception('Conflict between many data type rules');
        } elseif ($type_rules_count === 0) {
            throw new Exception('No data type rule was detected');
        }

        return match ($type_rules[0]) {
            'array' => new ArrayParameterFaker,
            'boolean' => new BooleanParameterFaker,
            'file' => new FileParameterFaker,
            'integer' => new IntegerParameterFaker,
            'numeric' => new NumericParameterFaker,
            'string' => new StringParameterFaker,
        };
    }
}
