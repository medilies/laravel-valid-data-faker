<?php

use Elaboratecode\ValidDataFaker\RulesSetNester;

it('converts doted keys rules to a nested structure', function (array $rules, array $undoted, array $expected_nested) {
    $nested = RulesSetNester::nest($rules);

    expect($nested)->toEqual($expected_nested);
})->with('rules');

it('sets exmples', function (array $rules_set, array $examples, array $expected_nested) {
    $nested = RulesSetNester::nest($rules_set, $examples);

    expect($nested)->toEqual($expected_nested);
})->with([
    'basic' => [
        [
            'foo' => ['string'],
            'bar' => ['integer'],
        ],
        ['foo' => 'example_value'],
        [
            'foo' => [
                'rules' => ['string'],
                'example' => 'example_value',
            ],
            'bar' => [
                'rules' => ['integer'],
            ],
        ],
    ],
    'dotted' => [
        [
            'batch.*.foo' => ['string'],
            'batch.*.bar' => ['integer'],
        ],
        ['batch.*.foo' => 'example_value'],
        [
            'batch' => [
                'children' => [
                    '*' => [
                        'children' => [
                            'foo' => [
                                'rules' => ['string'],
                                'example' => 'example_value',
                            ],
                            'bar' => [
                                'rules' => ['integer'],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
]);
