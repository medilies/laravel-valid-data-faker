<?php

namespace Elaboratecode\ValidDataFaker;

use Exception;
use Illuminate\Support\Arr;

final class RulesSetNester
{
    public static function nest(array $rules_set, array $examples = [])
    {
        $instance = new static();

        return $instance->normalize(
            $instance->undot(
                $instance->pushUnderRulesKey($rules_set, $examples)
            )
        )['children'];
    }

    protected function undot(array $set): array
    {
        return Arr::undot($set);
    }

    public function pushUnderRulesKey(array $rules_set, array $examples): array
    {
        foreach ($rules_set as $key => $value) {
            // ! forbid 'rules' as param name. or use a random str as key
            $rules_set[$key] = ['rules' => $value];

            if (isset($examples[$key])) {
                $rules_set[$key]['example'] = $examples[$key];
            }
        }

        return $rules_set;
    }

    protected function normalize(array $set): array
    {
        $normalized_set = [
            'children' => [],
        ];

        foreach ($set as $key => $value) {
            if ($key === 'rules') {
                $normalized_set['rules'] = $value;
            } elseif ($key === 'example') {
                $normalized_set['example'] = $value;
            } elseif (is_array($value)) {
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
