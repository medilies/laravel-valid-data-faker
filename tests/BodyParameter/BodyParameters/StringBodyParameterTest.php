<?php

use Elaboratecode\ValidDataFaker\BodyParameter\BodyParameters\StringBodyParameter;
use Illuminate\Support\Facades\Validator;

it('works', function (array $rules) {
    $string_body_param = new StringBodyParameter('foo', $rules);

    $validator = Validator::make(
        ['foo' => $string_body_param->generate()],
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
