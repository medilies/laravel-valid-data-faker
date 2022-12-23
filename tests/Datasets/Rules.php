<?php

return dataset('rules', [
    'physics' => [
        [
            'humidity' => ['required', 'numeric', 'min:0', 'max:100'],
            'pressure' => ['required', 'numeric', 'min:800', 'max:1200'],
            'temperature' => ['required', 'numeric', 'min:-100', 'max:100'],
        ],
        [
            'humidity' => ['required', 'numeric', 'min:0', 'max:100'],
            'pressure' => ['required', 'numeric', 'min:800', 'max:1200'],
            'temperature' => ['required', 'numeric', 'min:-100', 'max:100'],
        ],
        [
            'humidity' => [
                'rules' => ['required', 'numeric', 'min:0', 'max:100'],
            ],
            'pressure' => [
                'rules' => ['required', 'numeric', 'min:800', 'max:1200'],
            ],
            'temperature' => [
                'rules' => ['required', 'numeric', 'min:-100', 'max:100'],
            ],
        ],
    ],
    'users' => [
        [
            'data' => ['required', 'array'],
            'data.ids' => ['required', 'array'],
            'data.ids.*' => ['required', 'numeric', 'min:0'],
            'data.emails' => ['required', 'array'],
            'data.emails.*' => ['required', 'string', 'email'],
        ],
        [
            'data' => [
                'required',
                'array',
                'ids' => [
                    'required',
                    'array',
                    '*' => ['required', 'numeric', 'min:0'],
                ],
                'emails' => [
                    'required',
                    'array',
                    '*' => ['required', 'string', 'email'],
                ],
            ],
        ],
        [
            'data' => [
                'rules' => ['required', 'array'],
                'children' => [
                    'ids' => [
                        'rules' => ['required', 'array'],
                        'children' => [
                            '*' => [
                                'rules' => ['required', 'numeric', 'min:0'],
                            ],
                        ],
                    ],
                    'emails' => [
                        'rules' => ['required', 'array'],
                        'children' => [
                            '*' => [
                                'rules' => ['required', 'string', 'email'],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
]);
