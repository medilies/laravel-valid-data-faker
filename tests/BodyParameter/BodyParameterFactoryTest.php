<?php

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameterFactory;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\ArrayBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\BooleanBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\FileBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\IntegerBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\NumericBodyParameter;
use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\StringBodyParameter;
use Elaboratecode\ValidDataFaker\Exceptions\BodyParameterInstanciationException;

it('makes', function (array $rules, string $body_param_class) {
    $body_params_factory = new BodyParameterFactory;

    $body_param = $body_params_factory->make('foo', $rules);

    expect($body_param)->toBeInstanceOf($body_param_class);
})->with([
    'boolean' => [
        ['required', 'boolean'],
        BooleanBodyParameter::class,
    ],
    'file' => [
        ['required', 'file'],
        FileBodyParameter::class,
    ],
    'integer' => [
        ['required', 'integer'],
        IntegerBodyParameter::class,
    ],
    'numeric' => [
        ['required', 'numeric'],
        NumericBodyParameter::class,
    ],
    'string' => [
        ['required', 'string'],
        StringBodyParameter::class,
    ],
]);

it('makes array', function (array $rules, string $body_param_class, $children) {
    $body_params_factory = new BodyParameterFactory;

    $body_param = $body_params_factory->make('foo', $rules, $children);

    expect($body_param)->toBeInstanceOf($body_param_class);
})->with([
    'array' => [
        ['required', 'array'],
        ArrayBodyParameter::class,
        [],
    ],
]);

it('throws when no BodyParameters BodyParameter is matched')
    ->expect(fn () => (new BodyParameterFactory)->make('foo', ['no-type-rule']))
    ->throws(BodyParameterInstanciationException::class);

it('throws when primitive params receive children')
    ->expect(fn () => (new BodyParameterFactory)->make('foo', ['boolean'], []))
    ->throws(BodyParameterInstanciationException::class);
