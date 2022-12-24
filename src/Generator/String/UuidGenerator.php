<?php

namespace Elaboratecode\ValidDataFaker\Generator\String;

use Elaboratecode\ValidDataFaker\Concerns\WithFaker;
use Elaboratecode\ValidDataFaker\Generator\Generator;

class UuidGenerator extends Generator
{
    use WithFaker;

    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        return $this->faker->uuid();
    }
}
