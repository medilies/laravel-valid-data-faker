<?php

use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakerFactory;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\ArrayParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\BooleanParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\FileParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\IntegerParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\NumericParameterFaker;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\StringParameterFaker;

it('makes', function (array $rules, string $param_faker_class) {
    $param_fakers_factory = new ParameterFakerFactory;

    $param_faker = $param_fakers_factory->make('foo', $rules);

    expect($param_faker)->toBeInstanceOf($param_faker_class);
})->with([
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

it('makes array', function (array $rules, string $param_faker_class, $children) {
    $param_fakers_factory = new ParameterFakerFactory;

    $param_faker = $param_fakers_factory->make('foo', $rules, $children);

    expect($param_faker)->toBeInstanceOf($param_faker_class);
})->with([
    'array' => [
        ['required', 'array'],
        ArrayParameterFaker::class,
        [],
    ],
]);

it('throws when no ParameterFakers ParameterFaker is matched')
    ->expect(fn () => (new ParameterFakerFactory)->make('foo', ['no-type-rule']))
    ->throws(Exception::class);

it('throws when primitive params receive children')
    ->expect(fn () => (new ParameterFakerFactory)->make('foo', ['boolean'], []))
    ->throws(Exception::class);
