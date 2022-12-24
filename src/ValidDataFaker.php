<?php

namespace Elaboratecode\ValidDataFaker;

use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakerFactory;

class ValidDataFaker
{
    /** @var ParameterFaker[] */
    protected array $param_fakers;

    protected array $rules_set;

    protected ParameterFakerFactory $param_fakers_factory;

    public function __construct(array $rules_set)
    {
        $this->param_fakers_factory = new ParameterFakerFactory;

        $this->rules_set = RulesSetNester::nest($rules_set);

        $this->setTopLevelParamsFakers();
    }

    public function setTopLevelParamsFakers(): void
    {
        foreach ($this->rules_set as $param_name => $details) {
            $this->param_fakers[$param_name] = $this->param_fakers_factory->make(
                $param_name,
                $details['rules'],
                $details['children'] ?? null
            );
        }
    }

    public function generate(): array
    {
        $data = [];

        foreach ($this->param_fakers as $param_name => $param_faker) {
            $data[$param_name] = $param_faker->generate();
        }

        return $data;
    }
}
