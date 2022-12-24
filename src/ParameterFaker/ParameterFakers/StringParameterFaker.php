<?php

namespace Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFakers;

use Elaboratecode\ValidDataFaker\Concerns\WithFaker;
use Elaboratecode\ValidDataFaker\Exceptions\ConflictedRulesException;
use Elaboratecode\ValidDataFaker\ParameterFaker\ParameterFaker;

class StringParameterFaker extends ParameterFaker
{
    use WithFaker;

    protected array $modifier_rules = [
        'after', // Date
        'after_or_equal', // Date
        'alpha',
        'alpha_dash',
        'alpha_num',
        'ascii',
        'before', // Date
        'before_or_equal', // Date
        'date', // Date
        'date_equals', // Date
        'date_format', // Date
        'doesnt_start_with',
        'doesnt_end_with',
        'email', // Email
        'ends_with',
        // 'gt', // Size // ! Dependant
        // 'gte', // Size // ! Dependant
        // 'in_array', // ! Dependant
        'ip', // IP
        'ip4', // IP
        'ip6', // IP
        'json',
        // 'lt', // Size // ! Dependant
        // 'lte', // Size // ! Dependant
        'lowercase',
        'mac_address', // MAC
        'max',
        'min',
        'not_in',
        'not_regex',
        'regex',
        'size', // Size
        'starts_with',
        'timezone', // Timezone
        'uppercase',
        'url', // URL
        'ulid', // ULID
        'uuid', // UUID
    ];

    protected ?string $special_string;

    protected string $generator;

    public function __construct(
        string $param_name,
        array $rules,
    ) {
        parent::__construct($param_name, $rules);

        $this->dateRuleCheck();
        $this->ipRuleCheck();

        $this->setSpecialString();

        $this->setGenerator();
    }

    public function generate(): string
    {
        return $this->faker->{$this->generator}();
    }

    /**
     * Inject 'date' rule
     */
    protected function dateRuleCheck(): void
    {
        if (in_array('date', $this->rules)) {
            return;
        }

        // TODO: Check conflicts here ?
        if (count(array_intersect($this->rules, ['after', 'after_or_equal', 'before', 'before_or_equal', 'date_equals', 'date_format'])) > 1) {
            $this->injectRule('date');
        }
    }

    /**
     * Inject 'ip' rule
     */
    protected function ipRuleCheck(): void
    {
        if (in_array('ip', $this->rules)) {
            return;
        }

        // TODO: Check conflicts here ?
        if (count(array_intersect($this->rules, ['ip4', 'ip6'])) > 1) {
            $this->injectRule('ip');
        }
    }

    protected function setSpecialString(): void
    {
        $matched_special_string_rules = array_values(array_intersect(
            $this->rules,
            ['date', 'email', 'ip', 'json', 'mac_address', 'timezone', 'url', 'ulid', 'uuid']
        ));

        if (count($matched_special_string_rules) > 1) {
            throw new ConflictedRulesException('Conflicted string rules: '.implode(',', $matched_special_string_rules));
        }

        if (count($matched_special_string_rules) === 1) {
            $this->special_string = array_values($matched_special_string_rules)[0];

            return;
        }

        $this->special_string = null;
    }

    protected function setGenerator(): void
    {
        if (! is_null($this->special_string)) {
            $this->generator = match ($this->special_string) {
                'date' => 'date',
                'email' => 'email',
                'ip' => 'ipv4',
                'json' => 'json',
                'mac_address' => 'macAddress',
                'timezone' => 'timezone',
                'url' => 'url',
                'ulid' => 'uuid',
                'uuid' => 'uuid',
            };
        }
    }
}
