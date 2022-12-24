<?php

namespace Elaboratecode\ValidDataFaker\Generator\String;

use Elaboratecode\ValidDataFaker\Concerns\WithFaker;
use Elaboratecode\ValidDataFaker\Generator\Generator;
use Exception;

class JsonGenerator extends Generator
{
    use WithFaker;

    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        throw new Exception('Not implemented');
    }
}
