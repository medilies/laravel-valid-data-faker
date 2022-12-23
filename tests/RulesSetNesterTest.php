<?php

use Elaboratecode\ValidDataFaker\RulesSetNester;

it('can test', function ($rules, $undoted, $expected_nested) {
    $valid_data_faker = new RulesSetNester($rules);

    $nested = $valid_data_faker->nest($rules);

    expect($nested)->toEqual($expected_nested);
})->with('rules');
