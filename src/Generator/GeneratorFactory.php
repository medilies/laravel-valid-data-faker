<?php

namespace Elaboratecode\ValidDataFaker\Generator;

class GeneratorFactory
{
    public function make(string $type, string $name): Generator
    {
        $generator_name = __NAMESPACE__.'\\'.$type.'\\'.$name.'Generator';

        return new $generator_name;
    }
}
