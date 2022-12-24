<?php

use Elaboratecode\ValidDataFaker\ValidDataFaker;
use Illuminate\Support\Facades\Validator;

it('generates valid data sets', function (array $rules_set) {
    $generated = (new ValidDataFaker($rules_set))->generate();

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
