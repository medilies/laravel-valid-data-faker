<?php

namespace Elaboratecode\ValidDataFaker;

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameterFactory;

class ValidDataFaker
{
    /** @var BodyParameter[] */
    protected array $body;

    protected array $rules_set;

    protected BodyParameterFactory $body_params_factory;

    public function __construct(array $rules_set, array $examples = [])
    {
        $this->body_params_factory = new BodyParameterFactory;

        $this->rules_set = RulesSetNester::nest($rules_set, $examples);

        $this->makeBody();
    }

    public function makeBody(): void
    {
        foreach ($this->rules_set as $param_name => $details) {
            $this->body[$param_name] = $this->body_params_factory->make(
                $param_name,
                $details['rules'],
                $details['children'] ?? null,
                $details['example'] ?? null
            );
        }
    }

    public function getFilledBody(): array
    {
        $data = [];

        foreach ($this->body as $param_name => $body_param) {
            $data[$param_name] = $body_param->generate();
        }

        return $data;
    }
}
