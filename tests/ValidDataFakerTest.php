<?php

use Elaboratecode\ValidDataFaker\ValidDataFaker;
use Illuminate\Support\Facades\Validator;

it('generates valid data sets', function (array $rules_set) {
    $generated = (new ValidDataFaker($rules_set))->getFilledBody();

    $validator = Validator::make(
        $generated,
        $rules_set
    );

    expect($validator->passes())->toBeTrue();
})->with([
    'special strings rules' => [
        [
            'date' => ['required', 'string', 'date'],
            'email' => ['required', 'string', 'email'],
            'ip' => ['required', 'string', 'ip'],
            'mac_address' => ['required', 'string', 'mac_address'],
            'timezone' => ['required', 'string', 'timezone'],
            'url' => ['required', 'string', 'url'],
            'uuid' => ['required', 'string', 'uuid'],
        ],
    ],
]);

it('gives priority to exmples', function (bool $passes, array $rules_set, array $examples) {
    $generated = (new ValidDataFaker($rules_set, $examples))->getFilledBody();

    $validator = Validator::make(
        $generated,
        $rules_set
    );

    expect($validator->passes())->toBe($passes);
})->with([
    'int on int' => [
        true,
        [
            'date' => ['required', 'integer'],
        ],
        ['date' => 1],
    ],
    'int on date' => [
        false,
        [
            'date' => ['required', 'string', 'date'],
        ],
        ['date' => 1],
    ],
]);
