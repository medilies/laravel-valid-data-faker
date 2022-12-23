<?php

use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\ArrayParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\BooleanParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\FileParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\IntegerParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\NumericParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\Concrete\StringParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFakers\ParameterFakerFactory;

it('makes', function ($rules, $param_faker_class) {
    $param_fakers_factory = new ParameterFakerFactory;

    $param_faker = $param_fakers_factory->make('foo', [
        'rules' => $rules,
    ]);

    expect($param_faker)->toBeInstanceOf($param_faker_class);
})->with([
    'array' => [
        ['required', 'array'],
        ArrayParameterFaker::class,
    ],
    'boolean' => [
        ['required', 'boolean'],
        BooleanParameterFaker::class,
    ],
    'file' => [
        ['required', 'file'],
        FileParameterFaker::class,
    ],
    'integer' => [
        ['required', 'integer'],
        IntegerParameterFaker::class,
    ],
    'numeric' => [
        ['required', 'numeric'],
        NumericParameterFaker::class,
    ],
    'string' => [
        ['required', 'string'],
        StringParameterFaker::class,
    ],
]);

it('throws when no concrete ParameterFaker is matched')
    ->expect(
        fn () => (new ParameterFakerFactory)->make('foo', [
            'rules' => ['no-type-rule'],
        ])
    )
    ->throws(Exception::class);
