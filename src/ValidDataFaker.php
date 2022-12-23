<?php

namespace Elaboratecode\ValidDataFaker;

use Exception;
use Illuminate\Support\Arr;

class ValidDataFaker
{
    public function nest($rules_set)
    {
        return $this->normalize($this->undot($rules_set))['children'];
    }

    protected function undot(array $set)
    {
        return Arr::undot($set);
    }

    protected function normalize(array $set)
    {
        $normalized_set = [
            'rules' => [],
            'children' => [],
        ];

        foreach ($set as $key => $value) {
            if (is_int($key)) {
                $normalized_set['rules'][] = $value;
            } elseif (is_string($key) && is_array($value)) {
                $normalized_set['children'][$key] = $this->normalize($value);
            } else {
                throw new Exception('unexpected rules set entry', 1);
            }
        }

        if (! count($normalized_set['children'])) {
            unset($normalized_set['children']);
        }

        return $normalized_set;
    }
}
