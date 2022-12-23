<?php

use Elaboratecode\ValidDataFaker\ValidDataFaker;

it('can test', function ($rules, $undoted, $expected_nested) {
    $nested = (new ValidDataFaker)->nest($rules);

    expect($nested)->toEqual($expected_nested);
})->with('rules');
