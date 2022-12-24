<?php

use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers\StringParameterFaker;
use Illuminate\Support\Facades\Validator;

it('works', function (array $rules) {
    $string_param_faker = new StringParameterFaker('foo', $rules);

    $validator = Validator::make(
        ['foo' => $string_param_faker->generate()],
        ['foo' => $rules]
    );

    expect($validator->passes())->toBeTrue();
})->with([
    'date' => [['string', 'date']],
    'ip' => [['string', 'ip']],
    'email' => [['string', 'email']],
    'mac_address' => [['string', 'mac_address']],
    'timezone' => [['string', 'timezone']],
    'url' => [['string', 'url']],
    // "ulid" => [['string', 'ulid']],
    'uuid' => [['string', 'uuid']],
]);
