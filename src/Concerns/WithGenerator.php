<?php

namespace Elaboratecode\ValidDataFaker\Concerns;

use Elaboratecode\ValidDataFaker\Generator\Generator;
use Elaboratecode\ValidDataFaker\Generator\GeneratorFactory;

trait WithGenerator
{
    protected ?Generator $generator = null;

    protected GeneratorFactory $generator_factory;

    protected function setUpWithGenerator(): void
    {
        $this->generator_factory = new GeneratorFactory;
    }

    protected function makeGenerator(string $type, string $name): Generator
    {
        return $this->generator_factory->make($type, $name);
    }
}
