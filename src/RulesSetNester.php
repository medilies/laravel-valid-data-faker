<?php

namespace Elaboratecode\ValidDataFaker;

use Exception;
use Illuminate\Support\Arr;

class RulesSetNester
{
    public static function nest(array $rules_set)
    {
        $instance = new static();

        return $instance->normalize(
            $instance->undot(
                $instance->pushUnderRulesKey($rules_set)
            )
        )['children'];
    }

    protected function undot(array $set)
    {
        return Arr::undot($set);
    }

    /**
     * ! forbid 'rules' as param name
     */
    public function pushUnderRulesKey(array $rules_set)
    {
        foreach ($rules_set as $key => $value) {
            $rules_set[$key] = ['rules' => $value];
        }

        return $rules_set;
    }

    protected function normalize(array $set)
    {
        $normalized_set = [
            'children' => [],
        ];

        foreach ($set as $key => $value) {
            if ($key === 'rules') {
                $normalized_set['rules'] = $value;
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
