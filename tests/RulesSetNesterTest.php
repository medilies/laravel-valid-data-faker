<?php

use Elaboratecode\ValidDataFaker\RulesSetNester;

it('can test', function ($rules, $undoted, $expected_nested) {
    $nested = RulesSetNester::nest($rules);

    expect($nested)->toEqual($expected_nested);
})->with('rules');
