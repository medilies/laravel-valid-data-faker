<?php

use Elaboratecode\ValidDataFaker\ParameterFakers\ParameterFakerFactory;

it('makes', function () {
    $param_fakers_factory = new ParameterFakerFactory;

    $param_faker = $param_fakers_factory->make('humidity', [
        'rules' => ['required', 'numeric', 'min:0', 'max:100'],
    ]);

    expect($param_faker)->toBeInstanceOf(stdClass::class);
});
