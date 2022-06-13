<?php

namespace App\Filters;

class RulesBuilder
{
    const FILTER_TYPE_LIST  = 'list';
    const FILTER_TYPE_VALUE = 'value';

    const FILTER_ACTION_HIDE_OTHER = 'hide others';
    const FILTER_ACTION_HIDE = 'hide';
    const FILTER_ACTION_SHOW = 'show';

    private array $hideOthersRules = [];
    private array $rules = [];

    public function build(array $config)
    {
        foreach ($config as $configRule) {
            $rule = new Rule($configRule['payment_method_id']);

            foreach ($configRule['fields'] as $fieldName => $configField) {

                if ($configField['type'] === self::FILTER_TYPE_LIST) {
                    $rule->addFilter(new ListFilter($fieldName, $configField['values'], $configField['rule_type']));
                }

                if ($configField['type'] === self::FILTER_TYPE_VALUE) {
                    $rule->addFilter(new ValueFilter($fieldName, $configField['value'], $configField['operation']));
                }
            }

            if ($configRule['rule_type'] === self::FILTER_ACTION_HIDE_OTHER) {
                $this->hideOthersRules[] = $rule;
            } else {
                $this->rules[] = $rule;
            }
        }
    }

    /**
     * @return array
     */
    public function getHideOthersRules(): array
    {
        return $this->hideOthersRules;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}
